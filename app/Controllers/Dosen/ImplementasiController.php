<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\Selection\PmwSelectionImplementasiModel;
use App\Models\Implementation\PmwImplementationItemModel;
use App\Models\Implementation\PmwImplementationPaymentModel;
use App\Models\Implementation\PmwImplementationKonsumsiModel;
use App\Models\LecturerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class ImplementasiController extends BaseController
{
    use ResponseTrait;

    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List of submitted implementation reports for this lecturer
     */
    public function index()
    {
        $proposalModel  = new PmwProposalModel();
        $lecturerUserId = auth()->id();

        $statusFilter = $this->request->getGet('status');
        $proposals    = $proposalModel->getProposalsForLecturerImplementasi((int) $lecturerUserId, $statusFilter);

        // Stats
        $allProposals = $proposalModel->getProposalsForLecturerImplementasi((int) $lecturerUserId);
        $stats = [
            'total'    => count($allProposals),
            'pending'  => count(array_filter($allProposals, fn($p) => $p['dosen_status'] === 'pending')),
            'approved' => count(array_filter($allProposals, fn($p) => $p['dosen_status'] === 'approved')),
            'revision' => count(array_filter($allProposals, fn($p) => $p['dosen_status'] === 'revision')),
        ];

        return view('dosen/implementasi/index', [
            'title'        => 'Validasi Implementasi | PMW Polsri',
            'proposals'    => $proposals,
            'stats'        => $stats,
            'statusFilter' => $statusFilter,
        ]);
    }

    /**
     * Show detail of one implementation report
     */
    public function detail(int $proposalId)
    {
        $lecturerModel = new LecturerModel();
        $lecturer      = $lecturerModel->where('user_id', auth()->id())->first();

        if (!$lecturer) {
            return redirect()->to('dosen/implementasi')->with('error', 'Profil dosen tidak ditemukan.');
        }

        $proposalModel = new PmwProposalModel();
        $proposal      = $proposalModel->getProposalForValidation($proposalId);

        // Security: ensure this lecturer is assigned to this proposal
        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) {
            return redirect()->to('dosen/implementasi')->with('error', 'Akses ditolak.');
        }

        $selectionModel = new PmwSelectionImplementasiModel();
        $selection      = $selectionModel->getByProposal($proposalId);

        if (!$selection || empty($selection->student_submitted_at)) {
            return redirect()->to('dosen/implementasi')->with('error', 'Laporan belum dikirim oleh mahasiswa.');
        }

        $memberModel = new PmwProposalMemberModel();
        $members     = $memberModel->getByProposalId($proposalId);

        $itemModel  = new PmwImplementationItemModel();
        $items      = $itemModel->getItemsWithPhotos($proposalId);

        $paymentModel = new PmwImplementationPaymentModel();
        $payments     = $paymentModel->getByProposalId($proposalId);

        $konsumsiModel = new PmwImplementationKonsumsiModel();
        $konsumsi      = $konsumsiModel->getByProposalId($proposalId);

        $totalPrice = $itemModel->getTotalPrice($proposalId);

        return view('dosen/implementasi/detail', [
            'title'      => 'Detail Implementasi | PMW Polsri',
            'proposal'   => $proposal,
            'selection'  => $selection,
            'members'    => $members,
            'items'      => $items,
            'payments'   => $payments,
            'konsumsi'   => $konsumsi,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Serve implementation photo securely for Dosen view
     */
    public function viewPhoto(int $photoId): ResponseInterface
    {
        $lecturerModel = new LecturerModel();
        $lecturer      = $lecturerModel->where('user_id', auth()->id())->first();
        if (!$lecturer) return $this->response->setStatusCode(403);

        $photoModel = new \App\Models\Implementation\PmwImplementationItemPhotoModel();
        $photo      = $photoModel->find($photoId);
        if (!$photo) return $this->response->setStatusCode(404);

        // Verify this photo's item belongs to a proposal assigned to this lecturer
        $itemModel = new PmwImplementationItemModel();
        $item      = $itemModel->find($photo->item_id);
        if (!$item) return $this->response->setStatusCode(404);

        $proposalModel = new PmwProposalModel();
        $proposal      = $proposalModel->getProposalForValidation((int) $item->proposal_id);
        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) return $this->response->setStatusCode(403);

        $absPath = WRITEPATH . $photo->file_path;
        if (!is_file($absPath)) return $this->response->setStatusCode(404);

        // Defensive mime type with fallback
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
     * Serve payment proof securely for Dosen view
     */
    public function viewPayment(int $paymentId): ResponseInterface
    {
        $lecturerModel = new LecturerModel();
        $lecturer      = $lecturerModel->where('user_id', auth()->id())->first();
        if (!$lecturer) return $this->response->setStatusCode(403);

        $paymentModel = new PmwImplementationPaymentModel();
        $payment      = $paymentModel->find($paymentId);
        if (!$payment) return $this->response->setStatusCode(404);

        $proposalModel = new PmwProposalModel();
        $proposal      = $proposalModel->getProposalForValidation($payment->proposal_id);
        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) return $this->response->setStatusCode(403);

        $absPath = WRITEPATH . $payment->file_path;
        if (!is_file($absPath)) return $this->response->setStatusCode(404);

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
     * Serve konsumsi documentation securely for Dosen view
     */
    public function viewKonsumsi(int $konsumsiId): ResponseInterface
    {
        $lecturerModel = new LecturerModel();
        $lecturer      = $lecturerModel->where('user_id', auth()->id())->first();
        if (!$lecturer) return $this->response->setStatusCode(403);

        $konsumsiModel = new PmwImplementationKonsumsiModel();
        $konsumsi      = $konsumsiModel->find($konsumsiId);
        if (!$konsumsi) return $this->response->setStatusCode(404);

        $proposalModel = new PmwProposalModel();
        $proposal      = $proposalModel->getProposalForValidation((int) $konsumsi->proposal_id);
        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) return $this->response->setStatusCode(403);

        $absPath = WRITEPATH . $konsumsi->file_path;
        if (!is_file($absPath)) return $this->response->setStatusCode(404);

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
     * Validate (approve/revision) implementation from Dosen
     */
    public function validateAction(int $proposalId)
    {
        $lecturerModel = new LecturerModel();
        $lecturer      = $lecturerModel->where('user_id', auth()->id())->first();

        if (!$lecturer) {
            if ($this->request->is('ajax')) {
                return $this->fail('Profil dosen tidak ditemukan.');
            }
            return redirect()->back()->with('error', 'Profil dosen tidak ditemukan.');
        }

        $proposalModel = new PmwProposalModel();
        $proposal      = $proposalModel->getProposalForValidation($proposalId);

        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) {
            if ($this->request->is('ajax')) {
                return $this->fail('Akses ditolak.');
            }
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $selectionModel = new PmwSelectionImplementasiModel();
        $selection      = $selectionModel->getByProposal($proposalId);

        if (!$selection || empty($selection->student_submitted_at)) {
            if ($this->request->is('ajax')) {
                return $this->fail('Laporan belum tersedia.');
            }
            return redirect()->back()->with('error', 'Laporan belum tersedia.');
        }

        // Support both 'action' (AJAX) and 'status' (Traditional Form)
        $action  = $this->request->getPost('status') ?: $this->request->getPost('action'); 
        $catatan = $this->request->getPost('catatan') ?? '';

        if (!in_array($action, ['approved', 'revision'])) {
            if ($this->request->is('ajax')) {
                return $this->fail('Aksi tidak valid.');
            }
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        if ($action === 'revision' && empty(trim($catatan))) {
            if ($this->request->is('ajax')) {
                return $this->fail('Catatan revisi wajib diisi.');
            }
            return redirect()->back()->with('error', 'Catatan revisi wajib diisi.');
        }

        $update = [
            'dosen_status'     => $action,
            'dosen_catatan'    => $action === 'revision' ? $catatan : null,
            'dosen_verified_at' => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if ($selectionModel->update($selection->id, $update)) {
            // Send notification to student (proposal leader)
            if (!empty($proposal['leader_user_id'])) {
                $notifModel = new \App\Models\NotificationModel();
                $msg = $action === 'approved'
                    ? "Laporan implementasi tim Anda ({$proposal['nama_usaha']}) telah disetujui oleh Dosen Pendamping."
                    : "Laporan implementasi tim Anda ({$proposal['nama_usaha']}) memerlukan revisi. Catatan: {$catatan}";

                $notifModel->createImplementasiVerificationNotification(
                    (int) $proposalId,
                    (int) $proposal['leader_user_id'],
                    $action,
                    $msg
                );
            }

            $label = $action === 'approved' ? 'disetujui' : 'dikembalikan untuk revisi';
            
            if ($this->request->is('ajax')) {
                return $this->respond([
                    'success'  => true,
                    'message'  => "Laporan implementasi berhasil {$label}.",
                    'redirect' => base_url('dosen/implementasi'),
                ]);
            }

            return redirect()->to('dosen/implementasi')->with('success', "Laporan implementasi berhasil {$label}.");
        }

        if ($this->request->is('ajax')) {
            return $this->fail('Gagal menyimpan keputusan validasi.');
        }
        return redirect()->back()->with('error', 'Gagal menyimpan keputusan validasi.');
    }
}
