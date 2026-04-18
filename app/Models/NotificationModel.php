<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'pmw_notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'user_id',
        'type',
        'title',
        'message',
        'link',
        'data_id',
        'is_read',
        'read_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get unread notifications for a user
     */
    public function getUnread(?int $userId = null, int $limit = 10): array
    {
        $builder = $this->builder();

        if ($userId !== null) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }

        return $builder->where('is_read', false)
                       ->orderBy('created_at', 'DESC')
                       ->limit($limit)
                       ->get()
                       ->getResultArray();
    }

    /**
     * Get all notifications for a user
     */
    public function getForUser(?int $userId = null, int $limit = 50): array
    {
        $builder = $this->builder();

        if ($userId !== null) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }

        return $builder->orderBy('created_at', 'DESC')
                       ->limit($limit)
                       ->get()
                       ->getResultArray();
    }

    /**
     * Count unread notifications
     */
    public function countUnread(?int $userId = null): int
    {
        $builder = $this->builder();

        if ($userId !== null) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }

        return $builder->where('is_read', false)
                        ->countAllResults();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(int $id): bool
    {
        return $this->update($id, [
            'is_read'  => true,
            'read_at'  => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Mark all as read for a user
     */
    public function markAllAsRead(?int $userId = null): bool
    {
        $builder = $this->builder();

        if ($userId !== null) {
            $builder->where('user_id', $userId);
        } else {
            $builder->where('user_id IS NULL');
        }

        return $builder->update([
            'is_read' => true,
            'read_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Create proposal submission notification for admins
     */
    public function createProposalNotification(int $proposalId, string $namaUsaha, string $ketuaNama): int
    {
        return $this->insert([
            'user_id'  => null,
            'type'     => 'proposal_submitted',
            'title'    => 'Proposal Baru Masuk',
            'message'  => "Terdapat proposal '{$namaUsaha}' oleh {$ketuaNama} menunggu persetujuan",
            'link'     => 'admin/validasi',
            'data_id'  => $proposalId,
            'is_read'  => false,
        ], true);
    }

    /**
     * Create validation result notification for student (Stage 3 - Pitching Desk)
     */
    public function createPitchingValidationNotification(int $userId, int $proposalId, string $namaUsaha, string $status, ?string $catatan = null): int
    {
        $statusMap = [
            'approved' => 'lolos',
            'rejected' => 'ditolak',
            'revision' => 'perlu revisi',
        ];

        $statusText = $statusMap[$status] ?? $status;

        $message = "Hasil Pitching Desk untuk '{$namaUsaha}' : {$statusText}";
        if ($catatan) {
            $message .= ". Catatan: {$catatan}";
        }

        return $this->insert([
            'user_id'  => $userId,
            'type'     => 'pitching_' . $status,
            'title'    => 'Hasil Pitching Desk',
            'message'  => $message,
            'link'     => 'mahasiswa/pitching-desk?notif_type=pitching',
            'data_id'  => $proposalId,
            'is_read'  => false,
        ], true);
    }

    /**
     * Create notification for lecturer when student submits pitching materials
     */
    public function createPitchingSubmissionNotification(int $lecturerUserId, int $proposalId, string $namaUsaha, string $ketuaNama): int
    {
        return $this->insert([
            'user_id'  => $lecturerUserId,
            'type'     => 'pitching_submitted',
            'title'    => 'Bahan Pitching Terkirim',
            'message'  => "Mahasiswa '{$ketuaNama}' telah mengirimkan bahan pitching untuk proposal '{$namaUsaha}'",
            'link'     => 'dosen/pitching-desk',
            'data_id'  => $proposalId,
            'is_read'  => false,
        ], true);
    }

    /**
     * Create validation result notification for student
     */
    public function createValidationResultNotification(int $userId, int $proposalId, string $namaUsaha, string $status, ?string $catatan = null): int
    {
        $statusMap = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'revision' => 'perlu revisi',
        ];

        $statusText = $statusMap[$status] ?? $status;

        $message = "Proposal '{$namaUsaha}' {$statusText}";
        if ($catatan) {
            $message .= ". Catatan: {$catatan}";
        }

        return $this->insert([
            'user_id'  => $userId,
            'type'     => 'proposal_' . $status,
            'title'    => 'Hasil Validasi Proposal',
            'message'  => $message,
            'link'     => 'mahasiswa/proposal',
            'data_id'  => $proposalId,
            'is_read'  => false,
        ], true);
    }

    /**
     * Create notification for Stage 4 (Wawancara/Perjanjian) Validation result
     */
    public function createWawancaraValidationNotification(int $proposalId, int $leaderUserId, string $status, string $message = '')
    {
        $statusLabel = [
            'approved' => 'LOLOS',
            'revision' => 'REVISI',
            'rejected' => 'DITOLAK'
        ][$status] ?? strtoupper($status);

        return $this->insert([
            'user_id' => $leaderUserId,
            'title'   => "Hasil Validasi Perjanjian: {$statusLabel}",
            'message' => $message ?: "Validasi berkas perjanjian implementasi Anda telah selesai dengan status {$statusLabel}.",
            'link'    => 'mahasiswa/perjanjian',
            'type'    => 'wawancara_' . $status,
            'data_id' => $proposalId,
            'is_read' => false,
        ], true);
    }

    /**
     * Create notification for Stage 5 (Announcement) Publication
     */
    public function createAnnouncementPublishedNotification(int $leaderUserId)
    {
        return $this->insert([
            'user_id' => $leaderUserId,
            'title'   => "📢 Pengumuman Kelolosan Dana",
            'message' => "SK Kelolosan Dana Tahap I telah dipublikasikan. Silakan cek status Anda.",
            'link'    => 'mahasiswa/pengumuman',
            'type'    => 'announcement',
            'is_read' => false,
        ], true);
    }

    /**
     * Create notification for Stage 7 (Implementasi) Verification
     */
    public function createImplementasiVerificationNotification(int $proposalId, int $leaderUserId, string $status, string $message = '')
    {
        $statusLabel = [
            'approved' => 'DISETUJUI',
            'revision' => 'REVISI',
            'rejected' => 'DITOLAK'
        ][$status] ?? strtoupper($status);

        return $this->insert([
            'user_id' => $leaderUserId,
            'title'   => "Update Validasi Implementasi: {$statusLabel}",
            'message' => $message ?: "Verifikasi data laporan implementasi Anda telah diperbarui menjadi {$statusLabel}.",
            'link'    => 'mahasiswa/implementasi',
            'type'    => 'implementasi_' . $status,
            'data_id' => $proposalId,
            'is_read' => false,
        ], true);
    }

    /**
     * Create notification for Guidance logbook verification result (Bimbingan/Mentoring)
     */
    public function createGuidanceVerificationNotification(int $leaderUserId, string $date, string $status, string $type = 'bimbingan')
    {
        $statusLabel = $status === 'verified' ? 'Diverifikasi ✅' : 'Perlu Revisi ⚠️';
        $route = $type === 'mentoring' ? 'mahasiswa/mentoring' : 'mahasiswa/bimbingan';
        $typeLabel = $type === 'mentoring' ? 'Mentoring' : 'Bimbingan';

        return $this->insert([
            'user_id' => $leaderUserId,
            'title'   => "Logbook {$typeLabel} {$statusLabel}",
            'message' => "Entri logbook {$typeLabel} tanggal {$date} telah {$statusLabel} oleh verifikator.",
            'link'    => $route,
            'type'    => 'guidance_verify',
            'is_read' => false,
        ], true);
    }

    /**
     * Create notification for new Guidance/Mentoring schedule
     */
    public function createGuidanceScheduleNotification(int $leaderUserId, string $time, string $location, string $type = 'bimbingan')
    {
        $route = $type === 'mentoring' ? 'mahasiswa/mentoring' : 'mahasiswa/bimbingan';
        $typeLabel = $type === 'mentoring' ? 'Mentoring' : 'Bimbingan';

        return $this->insert([
            'user_id' => $leaderUserId,
            'title'   => "📅 Jadwal {$typeLabel} Baru",
            'message' => "Jadwal {$typeLabel} baru telah dibuat pada {$time} ({$location}).",
            'link'    => $route,
            'type'    => 'guidance_schedule',
            'is_read' => false,
        ], true);
    }

    /**
     * Notify Dosen/Mentor when student submits a logbook entry
     */
    public function createLogbookSubmissionNotification(int $verifierUserId, string $teamName, string $date, string $type = 'bimbingan')
    {
        $typeLabel = $type === 'mentoring' ? 'Mentoring' : 'Bimbingan';
        $route = $type === 'mentoring' ? 'mentor/mentoring' : 'dosen/bimbingan';

        return $this->insert([
            'user_id' => $verifierUserId,
            'title'   => "📝 Logbook {$typeLabel} Baru",
            'message' => "Tim '{$teamName}' telah mengisi logbook {$typeLabel} untuk jadwal tanggal {$date}.",
            'link'    => $route,
            'type'    => 'logbook_submitted',
            'is_read' => false,
        ], true);
    }

    /**
     * Delete old notifications (keep last 30 days)
     */
    public function deleteOld(int $days = 30): int
    {
        $cutoff = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        return $this->where('created_at <', $cutoff)
                    ->delete();
    }
}
