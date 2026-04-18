<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwScheduleModel;
use App\Models\PmwPeriodModel;
use App\Models\Implementation\PmwImplementationItemPhotoModel;
use App\Models\Implementation\PmwImplementationPaymentModel;
use App\Models\Implementation\PmwImplementationKonsumsiModel;
use App\Services\PmwImplementasiService;
use App\Services\PmwPhaseAccessService;
use App\Services\PmwSelectionService;
use App\Entities\PmwImplementationItem;
use App\Entities\PmwImplementationItemPhoto;
use App\Entities\PmwImplementationPayment;
use App\Entities\PmwImplementationKonsumsi;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * @property IncomingRequest $request
 */
class ImplementasiController extends BaseController
{
    use ResponseTrait;

    protected $helpers = ['form', 'url', 'pmw'];

    private const PHASE_NUMBER = 7;

    protected $proposalModel;
    protected $scheduleModel;
    protected $periodModel;
    protected $implementasiService;

    public function __construct()
    {
        $this->proposalModel      = new PmwProposalModel();
        $this->scheduleModel      = new PmwScheduleModel();
        $this->periodModel        = new PmwPeriodModel();
        $this->implementasiService = new PmwImplementasiService();
    }

    /**
     * Helper to check if implementation phase is currently open
     */
    private function isPhaseOpen(): bool
    {
        $phaseAccess = new PmwPhaseAccessService();
        return $phaseAccess->isPhaseOpenForActivePeriod(self::PHASE_NUMBER);
    }

    /**
     * Main page - Show form and list
     */
    public function index()
    {
        $user = auth()->user();

        // Get active period
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return view('mahasiswa/implementasi', [
                'title'        => 'Implementasi List Perjanjian',
                'proposal'     => null,
                'activePeriod' => null,
                'phase'        => null,
                'isPhaseOpen'  => false,
                'canEdit'      => false,
            ]);
        }

        // Get proposal
        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        // Security check: Must have passed Tahap 6 (wawancara approved)
        $selectionService = new PmwSelectionService();
        if (!$proposal || !$selectionService->leaderPassedWawancara((int) $activePeriod['id'], (int) $user->id)) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Anda harus lolos Tahap I terlebih dahulu.');
        }

        // Get phase status
        $phaseAccess = new PmwPhaseAccessService();
        $phase       = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        $isPhaseOpen = $phaseAccess->isPhaseOpen($phase);

        // Check if can edit
        $canEdit = $this->implementasiService->canEdit($proposal['id'], $isPhaseOpen);

        // Get implementation data
        $implementationData = $this->implementasiService->getFullData($proposal['id']);

        // Get selection record
        $selectionModel = new \App\Models\Selection\PmwSelectionImplementasiModel();
        $selection = $selectionModel->getByProposal($proposal['id']);

        return view('mahasiswa/implementasi', [
            'title'              => 'Implementasi List Perjanjian',
            'proposal'           => $proposal,
            'activePeriod'       => $activePeriod,
            'phase'              => $phase,
            'isPhaseOpen'        => $isPhaseOpen,
            'canEdit'            => $canEdit,
            'selection'          => $selection,
            'items'              => $implementationData['items'],
            'payments'           => $implementationData['payments'],
            'konsumsi'           => $implementationData['konsumsi'],
            'totalPrice'         => $implementationData['total'],
        ]);
    }

    /**
     * Save new item (AJAX)
     */
    public function saveItem()
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Validation
        $rules = [
            'item_title'       => 'required|min_length[3]|max_length[255]',
            'item_description' => 'permit_empty|string',
            'category'         => 'permit_empty|string|max_length[100]',
            'qty'              => 'permit_empty|integer',
            'price'            => 'permit_empty|decimal',
        ];

        if (!$this->validate($rules)) {
            return $this->fail(implode(', ', $this->validator->getErrors()));
        }

        $data = [
            'item_title'       => $this->request->getPost('item_title'),
            'item_description' => $this->request->getPost('item_description'),
            'category'         => $this->request->getPost('category'),
            'qty'              => $this->request->getPost('qty') ?: 1,
            'price'            => $this->request->getPost('price') ?: 0,
        ];

        $itemId = $this->implementasiService->saveItem($proposal['id'], $activePeriod['id'], $data);

        if ($itemId) {
            return $this->respond([
                'success' => true,
                'message' => 'Komponen berhasil ditambahkan',
                'item_id' => $itemId,
            ]);
        }

        return $this->fail('Gagal menyimpan komponen');
    }

    /**
     * Upload photo for an item (AJAX)
     */
    public function uploadItemPhoto(int $itemId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        $photoTitle = $this->request->getPost('photo_title') ?: 'Foto Barang';
        $file       = $this->request->getFile('photo');

        // Security: Verify item belongs to this proposal
        $itemModel = new \App\Models\Implementation\PmwImplementationItemModel();
        $item      = $itemModel->find($itemId);
        if (!$item || $item->proposal_id != $proposal['id']) {
            return $this->fail('Akses ke item ditolak.');
        }

        $result = $this->implementasiService->uploadItemPhoto($itemId, $file, $photoTitle);

        if ($result['success']) {
            return $this->respond($result);
        }

        return $this->fail($result['message']);
    }

    /**
     * Upload payment proof (AJAX)
     */
    public function uploadPaymentProof()
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        $paymentTitle = $this->request->getPost('payment_title') ?: 'Bukti Pembayaran';
        $file         = $this->request->getFile('payment_file');

        $result = $this->implementasiService->uploadPaymentProof($proposal['id'], $activePeriod['id'], $file, $paymentTitle);

        if ($result['success']) {
            return $this->respond($result);
        }

        return $this->fail($result['message']);
    }

    /**
     * Upload konsumsi mentoring proof (AJAX)
     */
    public function uploadKonsumsi()
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        $konsumsiTitle = $this->request->getPost('konsumsi_title') ?: 'Bukti Konsumsi Mentoring';
        $file          = $this->request->getFile('konsumsi_file');

        $result = $this->implementasiService->uploadKonsumsiProof($proposal['id'], $activePeriod['id'], $file, $konsumsiTitle);

        if ($result['success']) {
            return $this->respond($result);
        }

        return $this->fail($result['message']);
    }

    /**
     * Delete an item
     */
    public function deleteItem(int $itemId)
    {
        if (!$this->request->is('ajax') && $this->request->getMethod() !== 'delete') {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify item belongs to this proposal
        $itemModel = new \App\Models\Implementation\PmwImplementationItemModel();
        $item      = $itemModel->find($itemId);

        if (!$item || $item->proposal_id != $proposal['id']) {
            return $this->fail('Barang tidak ditemukan.');
        }

        if ($this->implementasiService->deleteItem($itemId)) {
            return $this->respond(['success' => true, 'message' => 'Barang berhasil dihapus']);
        }

        return $this->fail('Gagal menghapus barang');
    }

    /**
     * Delete a photo
     */
    public function deletePhoto(int $photoId)
    {
        if (!$this->request->is('ajax') && $this->request->getMethod() !== 'delete') {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify photo belongs to an item of this proposal
        $photoModel = new \App\Models\Implementation\PmwImplementationItemPhotoModel();
        $photo      = $photoModel->find($photoId);

        if (!$photo) {
            return $this->fail('Foto tidak ditemukan.');
        }

        $itemModel = new \App\Models\Implementation\PmwImplementationItemModel();
        $item      = $itemModel->find($photo->item_id);

        if (!$item || !is_object($item) || $item->proposal_id != $proposal['id']) {
            return $this->fail('Akses ditolak.');
        }

        if ($photoModel->deletePhoto($photoId)) {
            return $this->respond(['success' => true, 'message' => 'Foto berhasil dihapus']);
        }

        return $this->fail('Gagal menghapus foto');
    }

    /**
     * Delete a payment proof
     */
    public function deletePayment(int $paymentId)
    {
        if (!$this->request->is('ajax') && $this->request->getMethod() !== 'delete') {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify payment belongs to this proposal
        $paymentModel = new \App\Models\Implementation\PmwImplementationPaymentModel();
        $payment      = $paymentModel->find($paymentId);

        if (!$payment || $payment->proposal_id != $proposal['id']) {
            return $this->fail('Bukti pembayaran tidak ditemukan.');
        }

        if ($paymentModel->deletePayment($paymentId)) {
            return $this->respond(['success' => true, 'message' => 'Bukti pembayaran berhasil dihapus']);
        }

        return $this->fail('Gagal menghapus bukti pembayaran');
    }

    /**
     * Delete a konsumsi proof
     */
    public function deleteKonsumsi(int $konsumsiId)
    {
        if (!$this->request->is('ajax') && $this->request->getMethod() !== 'delete') {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify konsumsi belongs to this proposal
        $konsumsiModel = new \App\Models\Implementation\PmwImplementationKonsumsiModel();
        $konsumsi      = $konsumsiModel->find($konsumsiId);

        if (!$konsumsi || $konsumsi->proposal_id != $proposal['id']) {
            return $this->fail('Bukti konsumsi tidak ditemukan.');
        }

        if ($konsumsiModel->deleteKonsumsi($konsumsiId)) {
            return $this->respond(['success' => true, 'message' => 'Bukti konsumsi berhasil dihapus']);
        }

        return $this->fail('Gagal menghapus bukti konsumsi');
    }

    /**
     * Update an item (AJAX PUT)
     */
    public function updateItem(int $itemId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify item belongs to this proposal
        $itemModel = new \App\Models\Implementation\PmwImplementationItemModel();
        $item      = $itemModel->find($itemId);

        if (!$item || $item->proposal_id != $proposal['id']) {
            return $this->fail('Komponen tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);

        $updateData = [
            'item_title'       => $data['item_title'] ?? $item->item_title,
            'item_description' => $data['item_description'] ?? $item->item_description,
            'category'         => $data['category'] ?? $item->category,
            'qty'              => $data['qty'] ?? $item->qty,
            'price'            => $data['price'] ?? $item->price,
        ];

        if ($this->implementasiService->updateItem($itemId, $updateData)) {
            return $this->respond(['success' => true, 'message' => 'Komponen berhasil diperbarui']);
        }

        return $this->fail('Gagal memperbarui komponen');
    }

    /**
     * Update a payment proof title (AJAX PUT)
     */
    public function updatePayment(int $paymentId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify payment belongs to this proposal
        $paymentModel = new \App\Models\Implementation\PmwImplementationPaymentModel();
        $payment      = $paymentModel->find($paymentId);

        if (!$payment || $payment->proposal_id != $proposal['id']) {
            return $this->fail('Bukti pembayaran tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);
        $paymentTitle = $data['payment_title'] ?? $payment->payment_title;

        if ($this->implementasiService->updatePayment($paymentId, ['payment_title' => $paymentTitle])) {
            return $this->respond(['success' => true, 'message' => 'Bukti pembayaran berhasil diperbarui']);
        }

        return $this->fail('Gagal memperbarui bukti pembayaran');
    }

    /**
     * Update a konsumsi proof title (AJAX PUT)
     */
    public function updateKonsumsi(int $konsumsiId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can edit
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Sesi pengisian laporan ditutup atau laporan sudah diverifikasi.');
        }

        // Verify konsumsi belongs to this proposal
        $konsumsiModel = new \App\Models\Implementation\PmwImplementationKonsumsiModel();
        $konsumsi      = $konsumsiModel->find($konsumsiId);

        if (!$konsumsi || $konsumsi->proposal_id != $proposal['id']) {
            return $this->fail('Bukti konsumsi tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);
        $konsumsiTitle = $data['konsumsi_title'] ?? $konsumsi->konsumsi_title;

        if ($this->implementasiService->updateKonsumsi($konsumsiId, ['konsumsi_title' => $konsumsiTitle])) {
            return $this->respond(['success' => true, 'message' => 'Bukti konsumsi berhasil diperbarui']);
        }

        return $this->fail('Gagal memperbarui bukti konsumsi');
    }

    /**
     * Reset all implementation data (if rejected)
     */
    public function resetAll()
    {
        if (!$this->request->is('ajax') && $this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Only allow reset if status is rejected
        if ($proposal['implementasi_status'] !== 'rejected') {
            return $this->fail('Reset hanya bisa dilakukan jika data ditolak.');
        }

        if ($this->implementasiService->resetAll($proposal['id'])) {
            return $this->respond([
                'success' => true,
                'message' => 'Semua data berhasil direset. Silakan input ulang.',
                'redirect' => base_url('mahasiswa/implementasi'),
            ]);
        }

        return $this->fail('Gagal mereset data');
    }
    /**
     * View/Preview implementation photo
     */
    public function viewPhoto(int $photoId): ResponseInterface
    {
        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return $this->response->setStatusCode(404);
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);
        if (!$proposal) {
            return $this->response->setStatusCode(403);
        }

        $photoModel = new PmwImplementationItemPhotoModel();
        /** @var PmwImplementationItemPhoto|null $photo */
        $photo      = $photoModel->find($photoId);

        if (!$photo) {
            return $this->response->setStatusCode(404);
        }

        // Verify photo belongs to an item of this proposal
        $itemModel = new \App\Models\Implementation\PmwImplementationItemModel();
        
        /** @var PmwImplementationItem|null $item */
        $item      = $itemModel->find($photo->item_id);

        if (!$item || (int) $item->proposal_id !== (int) $proposal['id']) {
            return $this->response->setStatusCode(403);
        }

        $absPath = WRITEPATH . $photo->file_path;
        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404);
        }

        // Defensive mime type with fallback
        try {
            $mimeType = mime_content_type($absPath) ?: 'image/jpeg';
        } catch (\Exception $e) {
            $mimeType = 'image/jpeg';
        }

        // Use is_object/array check just in case model behavior changes
        $originalName = is_object($photo) ? $photo->original_name : ($photo['original_name'] ?? 'photo.jpg');

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . $originalName . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * View/Preview payment proof
     */
    public function viewPayment(int $paymentId): ResponseInterface
    {
        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return $this->response->setStatusCode(404);
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);
        if (!$proposal) {
            return $this->response->setStatusCode(403);
        }

        $paymentModel = new PmwImplementationPaymentModel();
        
        /** @var PmwImplementationPayment|null $payment */
        $payment      = $paymentModel->find($paymentId);

        if (!$payment || (int) $payment->proposal_id !== (int) $proposal['id']) {
            return $this->response->setStatusCode(403);
        }

        $absPath = WRITEPATH . $payment->file_path;
        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404);
        }

        try {
            $mimeType = mime_content_type($absPath) ?: 'image/jpeg';
        } catch (\Exception $e) {
            $mimeType = 'image/jpeg';
        }

        $originalName = is_object($payment) ? $payment->original_name : ($payment['original_name'] ?? 'proof.jpg');

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . $originalName . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * View/Preview konsumsi proof
     */
    public function viewKonsumsi(int $konsumsiId): ResponseInterface
    {
        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return $this->response->setStatusCode(404);
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);
        if (!$proposal) {
            return $this->response->setStatusCode(403);
        }

        $konsumsiModel = new PmwImplementationKonsumsiModel();
        
        /** @var PmwImplementationKonsumsi|null $konsumsi */
        $konsumsi      = $konsumsiModel->find($konsumsiId);

        if (!$konsumsi || (int) $konsumsi->proposal_id !== (int) $proposal['id']) {
            return $this->response->setStatusCode(403);
        }

        $absPath = WRITEPATH . $konsumsi->file_path;
        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404);
        }

        try {
            $mimeType = mime_content_type($absPath) ?: 'image/jpeg';
        } catch (\Exception $e) {
            $mimeType = 'image/jpeg';
        }

        $originalName = is_object($konsumsi) ? $konsumsi->original_name : ($konsumsi['original_name'] ?? 'konsumsi.jpg');

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . $originalName . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * Submit implementation for verification (AJAX)
     */
    public function submit()
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Check if can submit (using canEdit logic which handles phase + revision)
        if (!$this->implementasiService->canEdit($proposal['id'], $this->isPhaseOpen())) {
            return $this->fail('Laporan tidak dapat dikirim karena sesi sudah ditutup atau sedang dalam proses review.');
        }

        // Check data completeness
        $data = $this->implementasiService->getFullData($proposal['id']);
        if (count($data['items']) === 0) {
            return $this->fail('Anda harus menginput minimal 1 barang belanja.');
        }

        if (count($data['payments']) === 0) {
            return $this->fail('Anda harus mengunggah minimal 1 bukti pembayaran.');
        }

        $selectionModel = new \App\Models\Selection\PmwSelectionImplementasiModel();
        $selection = $selectionModel->getByProposal($proposal['id']);

        if (!$selection) {
            return $this->fail('Data seleksi tidak ditemukan.');
        }

        // Check if already approved/rejected
        if (in_array($selection->admin_status, ['approved', 'rejected'])) {
            return $this->fail('Laporan sudah divalidasi dan tidak dapat dikirim ulang.');
        }

        $updateData = [
            'student_submitted_at' => date('Y-m-d H:i:s'),
            'dosen_status'         => 'pending',
            'admin_status'         => 'pending',
            'updated_at'           => date('Y-m-d H:i:s'),
        ];

        if ($selectionModel->update($selection->id, $updateData)) {
            // Get assignment to find lecturer
            $assignmentModel = new \App\Models\Proposal\PmwProposalAssignmentModel();
            $assignment = $assignmentModel->where('proposal_id', $proposal['id'])->first();

            if ($assignment && $assignment->lecturer_id) {
                $lecturerModel = new \App\Models\LecturerModel();
                $lecturer = $lecturerModel->find($assignment->lecturer_id);

                if ($lecturer && $lecturer['user_id']) {
                    $notifModel = new \App\Models\NotificationModel();
                    $notifModel->insert([
                        'user_id' => $lecturer['user_id'],
                        'type'    => 'implementasi_submitted',
                        'title'   => 'Laporan Implementasi Masuk',
                        'message' => "Tim '{$proposal['nama_usaha']}' telah mengirimkan laporan implementasi untuk divalidasi.",
                        'link'    => 'dosen/implementasi',
                        'data_id' => $proposal['id'],
                        'is_read' => false,
                    ]);
                }
            }

            return $this->respond([
                'success' => true,
                'message' => 'Laporan progress implementasi berhasil dikirim untuk verifikasi.',
                'redirect' => base_url('mahasiswa/implementasi')
            ]);
        }

        return $this->fail('Gagal mengirim laporan');
    }
}
