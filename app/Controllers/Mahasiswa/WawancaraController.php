<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwScheduleModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwDocumentModel;
use App\Services\PmwSelectionService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */
class WawancaraController extends BaseController
{
    use ResponseTrait;

    protected $helpers = ['form', 'url', 'pmw'];

    protected $proposalModel;
    protected $scheduleModel;
    protected $periodModel;
    protected $documentModel;
    protected $selectionService;

    public function __construct()
    {
        $this->proposalModel    = new PmwProposalModel();
        $this->scheduleModel    = new PmwScheduleModel();
        $this->periodModel      = new PmwPeriodModel();
        $this->documentModel    = new PmwDocumentModel();
        $this->selectionService = new PmwSelectionService();
    }

    public function index()
    {
        $user = auth()->user();
        
        // Get active period
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return view('mahasiswa/wawancara', [
                'title'        => 'Perjanjian Implementasi',
                'proposal'     => null,
                'activePeriod' => null,
                'phase'        => null,
                'isPhaseOpen'  => false
            ]);
        }

        // Get proposal
        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);
        
        // Security check: Must exist and must be approved in Pitching Desk
        if (!$proposal || $proposal['pitching_dosen_status'] !== 'approved' || $proposal['pitching_admin_status'] !== 'approved') {
            return redirect()->to('mahasiswa/pitching-desk')->with('error', 'Anda harus menyelesaikan tahap Pitching Desk terlebih dahulu.');
        }

        // Get phase status for "Wawancara Perjanjian" (Phase ID 4)
        $phase = $this->scheduleModel->where('period_id', $activePeriod['id'])
            ->where('id', 4) // Assuming 4 is Wawancara Perjanjian
            ->first();

        $isPhaseOpen = $this->isPhaseOpen($phase);

        // Get documents
        $docs = $this->documentModel->getProposalDocs($proposal['id']);

        $docsByKey = [];
        foreach ($docs as $doc) {
            $docsByKey[$doc['doc_key']] = $doc;
        }

        $isLocked = ($proposal['wawancara_status'] ?? 'pending') === 'approved';

        return view('mahasiswa/wawancara', [
            'title'        => 'Perjanjian Implementasi',
            'proposal'     => $proposal,
            'activePeriod' => $activePeriod,
            'phase'        => $phase,
            'isPhaseOpen'  => $isPhaseOpen,
            'isLocked'     => $isLocked,
            'docsByKey'    => $docsByKey
        ]);
    }

    public function upload()
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return $this->fail('Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->where('period_id', $activePeriod['id'])
            ->where('leader_user_id', $user->id)
            ->first();

        if (!$proposal) {
            return $this->fail('Proposal tidak ditemukan.');
        }

        // Phase 4: Wawancara / Perjanjian Implementasi
        $phase = $this->scheduleModel->where('period_id', $activePeriod['id'])
            ->where('phase_number', 4)
            ->first();
            
        if (!$this->isPhaseOpen($phase)) {
            return $this->fail('Jadwal pengunggahan berkas perjanjian belum dibuka atau sudah ditutup.');
        }

        $file = $this->request->getFile('perjanjian_file');
        if (!$file || !$file->isValid()) {
            return $this->fail($file ? $file->getErrorString() : 'File tidak ditemukan.');
        }

        if ($file->getSize() / 1024 / 1024 > 2) {
            return $this->fail('Ukuran file maksimal 2MB.');
        }

        if ($file->getMimeType() !== 'application/pdf') {
            return $this->fail('File harus berformat PDF.');
        }

        $docKey = 'bukti_perjanjian';
        
        // Use standard directory structure: uploads/pmw/proposals/proposal_{id}
        $proposalId = $proposal['id'];
        $targetDir = 'uploads/pmw/proposals/proposal_' . $proposalId;
        $absTargetDir = WRITEPATH . $targetDir;

        if (!is_dir($absTargetDir)) {
            mkdir($absTargetDir, 0775, true);
        }

        $slug = url_title($proposal['nama_usaha'] ?? 'perjanjian', '-', true);
        $timestamp = date('Ymd_His');
        $extension = $file->getClientExtension();
        $newName = "{$slug}-{$docKey}-{$timestamp}.{$extension}";

        if ($file->move($absTargetDir, $newName)) {
            $path = $targetDir . '/' . $newName;

            // Upsert document record
            $existingDoc = $this->documentModel->where([
                'proposal_id' => $proposalId,
                'type'        => 'perjanjian',
                'doc_key'     => $docKey
            ])->first();

            if ($existingDoc) {
                // Physical cleanup of the old file
                $oldPath = WRITEPATH . $existingDoc['file_path'];
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }

                $this->documentModel->update($existingDoc['id'], [
                    'file_path'     => $path,
                    'original_name' => $file->getClientName(),
                    'status'        => 'submitted',
                    'version'       => ($existingDoc['version'] ?? 1) + 1
                ]);
            } else {
                $this->documentModel->insert([
                    'proposal_id'   => $proposalId,
                    'uploader_id'   => $user->id,
                    'type'          => 'perjanjian',
                    'doc_key'       => $docKey,
                    'file_path'     => $path,
                    'original_name' => $file->getClientName(),
                    'status'        => 'submitted',
                    'version'       => 1
                ]);
            }

            // Update wawancara selection status (and set submission timestamp)
            $this->selectionService->updateWawancaraStatus($proposalId, 'pending', true);

            return $this->respond([
                'success'  => true,
                'message'  => 'Berkas perjanjian berhasil diunggah.',
                'filename' => $file->getClientName()
            ]);
        }

        return $this->fail('Gagal memindahkan file yang diunggah.');
    }

    private function isPhaseOpen($phase): bool
    {
        if (!$phase) return false;
        $now = date('Y-m-d');
        return ($now >= $phase['start_date'] && $now <= $phase['end_date']);
    }
}
