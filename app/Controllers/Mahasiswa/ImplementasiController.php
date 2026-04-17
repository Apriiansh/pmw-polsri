<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwScheduleModel;
use App\Models\PmwPeriodModel;
use App\Services\PmwImplementasiService;
use App\Services\PmwPhaseAccessService;
use App\Services\PmwSelectionService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\IncomingRequest;

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
        if (!$proposal || !$selectionService->leaderPassedStage1((int) $activePeriod['id'], (int) $user->id)) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Anda harus lolos Tahap I terlebih dahulu.');
        }

        // Get phase status
        $phaseAccess = new PmwPhaseAccessService();
        $phase       = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        $isPhaseOpen = $phaseAccess->isPhaseOpen($phase);

        // Check if can edit
        $canEdit = $isPhaseOpen && $this->implementasiService->canEdit($proposal['id']);

        // Get implementation data
        $implementationData = $this->implementasiService->getFullData($proposal['id']);

        return view('mahasiswa/implementasi', [
            'title'              => 'Implementasi List Perjanjian',
            'proposal'           => $proposal,
            'activePeriod'       => $activePeriod,
            'phase'              => $phase,
            'isPhaseOpen'        => $isPhaseOpen,
            'canEdit'            => $canEdit,
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
        }

        // Validation
        $rules = [
            'item_title'       => 'required|min_length[3]|max_length[255]',
            'item_description' => 'permit_empty|string',
            'price'            => 'permit_empty|decimal',
        ];

        if (!$this->validate($rules)) {
            return $this->fail(implode(', ', $this->validator->getErrors()));
        }

        $data = [
            'item_title'       => $this->request->getPost('item_title'),
            'item_description' => $this->request->getPost('item_description'),
            'price'            => $this->request->getPost('price') ?: 0,
        ];

        $itemId = $this->implementasiService->saveItem($proposal['id'], $activePeriod['id'], $data);

        if ($itemId) {
            return $this->respond([
                'success' => true,
                'message' => 'Barang berhasil ditambahkan',
                'item_id' => $itemId,
            ]);
        }

        return $this->fail('Gagal menyimpan barang');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
        }

        $photoTitle = $this->request->getPost('photo_title') ?: 'Foto Barang';
        $file       = $this->request->getFile('photo');

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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat dihapus.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat dihapus.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat dihapus.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat dihapus.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
        }

        // Verify item belongs to this proposal
        $itemModel = new \App\Models\Implementation\PmwImplementationItemModel();
        $item      = $itemModel->find($itemId);

        if (!$item || $item->proposal_id != $proposal['id']) {
            return $this->fail('Barang tidak ditemukan.');
        }

        $data = $this->request->getJSON(true);

        $updateData = [
            'item_title'       => $data['item_title'] ?? $item->item_title,
            'item_description' => $data['item_description'] ?? $item->item_description,
            'price'            => $data['price'] ?? $item->price,
        ];

        if ($this->implementasiService->updateItem($itemId, $updateData)) {
            return $this->respond(['success' => true, 'message' => 'Barang berhasil diperbarui']);
        }

        return $this->fail('Gagal memperbarui barang');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
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
        if (!$this->implementasiService->canEdit($proposal['id'])) {
            return $this->fail('Data sudah diverifikasi dan tidak dapat diubah.');
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
}
