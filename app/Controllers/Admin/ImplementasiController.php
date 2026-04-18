<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Implementation\PmwImplementationItemModel;
use App\Models\Implementation\PmwImplementationItemPhotoModel;
use App\Models\Implementation\PmwImplementationPaymentModel;
use App\Models\Implementation\PmwImplementationKonsumsiModel;
use App\Services\PmwImplementasiService;
use CodeIgniter\HTTP\ResponseInterface;

class ImplementasiController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    protected $proposalModel;
    protected $implementasiService;

    public function __construct()
    {
        $this->proposalModel       = new PmwProposalModel();
        $this->implementasiService = new PmwImplementasiService();
    }

    /**
     * List all teams with implementation submissions
     */
    public function index(): ResponseInterface
    {
        $db = \Config\Database::connect();
        $statusFilter = $this->request->getGet('status');

        // Build query
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id',
            'p.nama_usaha',
            'si.admin_status as implementasi_status',
            'si.admin_catatan as implementasi_catatan',
            'si.dosen_status',
            'si.student_submitted_at',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'per.name as period_name',
            'per.year as period_year',
            '(SELECT COUNT(*) FROM pmw_implementation_items WHERE proposal_id = p.id) as item_count',
            '(SELECT SUM(price * COALESCE(qty,1)) FROM pmw_implementation_items WHERE proposal_id = p.id) as total_price',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_wawancara sw', 'sw.proposal_id = p.id', 'left');
        $builder->join('pmw_selection_implementasi si', 'si.proposal_id = p.id', 'left');

        // Only show where student has actually submitted
        $builder->where('sw.admin_status', 'approved');
        $builder->where('si.student_submitted_at IS NOT NULL', null, false);

        if ($statusFilter) {
            $builder->where('si.admin_status', $statusFilter);
        }

        $builder->orderBy('si.admin_status', 'ASC');
        $builder->orderBy('si.dosen_verified_at', 'DESC');

        $proposals = $builder->get()->getResultArray();

        // Stats
        $stats = [
            'total'    => 0,
            'pending'  => 0,
            'approved' => 0,
            'revision' => 0,
            'rejected' => 0,
        ];

        foreach ($proposals as $p) {
            $key = $p['implementasi_status'] ?? 'pending';
            if (isset($stats[$key])) {
                $stats[$key]++;
            }
            $stats['total']++;
        }

        return $this->response->setBody(view('admin/implementasi/index', [
            'title'        => 'Validasi Implementasi | PMW Polsri',
            'proposals'    => $proposals,
            'stats'        => $stats,
            'statusFilter' => $statusFilter,
        ]));
    }

    /**
     * Detail page for verification
     */
    public function detail(int $proposalId): ResponseInterface
    {
        $db = \Config\Database::connect();

        // Get proposal details
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id',
            'p.nama_usaha',
            'p.kategori_wirausaha',
            'si.admin_status as implementasi_status',
            'si.admin_catatan as implementasi_catatan',
            'si.dosen_status',
            'si.dosen_catatan',
            'si.dosen_verified_at',
            'si.student_submitted_at',
            'p.total_rab',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'l.jurusan as dosen_jurusan',
            'l.prodi as dosen_prodi',
            'l.phone as dosen_phone',
            'per.name as period_name',
            'per.year as period_year',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_implementasi si', 'si.proposal_id = p.id', 'left');
        $builder->where('p.id', $proposalId);

        $proposal = $builder->get()->getRowArray();

        if (!$proposal) {
            return redirect()->to('admin/implementasi')->with('error', 'Proposal tidak ditemukan');
        }

        // Get proposal members
        $memberModel = new \App\Models\Proposal\PmwProposalMemberModel();
        $members     = $memberModel->getByProposalId($proposalId);

        // Get implementation data
        $implementationData = $this->implementasiService->getFullData($proposalId);

        return $this->response->setBody(view('admin/implementasi/detail', [
            'title'        => 'Detail Validasi Implementasi | PMW Polsri',
            'proposal'     => $proposal,
            'members'      => $members,
            'items'        => $implementationData['items'],
            'payments'     => $implementationData['payments'],
            'konsumsi'     => $implementationData['konsumsi'],
            'totalPrice'   => $implementationData['total'],
        ]));
    }

    /**
     * Verify implementation submission
     */
    public function verify(int $proposalId): ResponseInterface
    {
        $selectionModel = new \App\Models\Selection\PmwSelectionImplementasiModel();

        $exists = $selectionModel->where('proposal_id', $proposalId)->first();
        if (!$exists) {
            return redirect()->to('admin/implementasi')->with('error', 'Data implementasi tidak ditemukan');
        }

        // Enforce: Dosen must have approved before Admin can act
        if ($exists->dosen_status !== 'approved') {
            return redirect()->back()->with('error', 'Dosen Pendamping harus menyetujui laporan implementasi terlebih dahulu sebelum Admin dapat melakukan verifikasi.');
        }

        $status  = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($status, ['approved', 'revision', 'rejected'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $updateData = [
            'admin_status'     => $status,
            'admin_catatan'    => $catatan ?: null,
            'admin_verified_at' => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if ($selectionModel->where('proposal_id', $proposalId)->set($updateData)->update()) {
            $statusText = [
                'approved' => 'disetujui',
                'revision' => 'direvisi',
                'rejected' => 'ditolak',
            ][$status];

            // Send Notification
            $proposal = $this->proposalModel->find($proposalId);
            if ($proposal) {
                $notifModel = new \App\Models\NotificationModel();
                $notifModel->createImplementasiVerificationNotification($proposalId, (int)$proposal['leader_user_id'], $status, $catatan);
            }

            return redirect()->to('admin/implementasi')
                ->with('success', "Validasi implementasi berhasil {$statusText}");
        }

        return redirect()->back()->with('error', 'Gagal menyimpan validasi');
    }

    /**
     * Download/Preview photo
     */
    public function viewPhoto(int $photoId): ResponseInterface
    {
        $photoModel = new PmwImplementationItemPhotoModel();
        $photo      = $photoModel->find($photoId);

        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan');
        }

        $absPath = WRITEPATH . $photo->file_path;

        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File fisik tidak ditemukan');
        }

        try {
            $mimeType = mime_content_type($absPath) ?: 'image/jpeg';
        } catch (\Exception $e) {
            $mimeType = 'image/jpeg';
        }

        $originalName = is_object($photo) ? $photo->original_name : ($photo['original_name'] ?? 'photo.jpg');

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . $originalName . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * Download/Preview payment proof
     */
    public function viewPayment(int $paymentId): ResponseInterface
    {
        $paymentModel = new PmwImplementationPaymentModel();
        $payment      = $paymentModel->find($paymentId);

        if (!$payment) {
            return redirect()->back()->with('error', 'Bukti pembayaran tidak ditemukan');
        }

        $absPath = WRITEPATH . $payment->file_path;

        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File fisik tidak ditemukan');
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
     * Download/Preview konsumsi proof
     */
    public function viewKonsumsi(int $konsumsiId): ResponseInterface
    {
        $konsumsiModel = new PmwImplementationKonsumsiModel();
        $konsumsi      = $konsumsiModel->find($konsumsiId);

        if (!$konsumsi) {
            return redirect()->back()->with('error', 'Bukti konsumsi tidak ditemukan');
        }

        $absPath = WRITEPATH . $konsumsi->file_path;

        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File fisik tidak ditemukan');
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
}
