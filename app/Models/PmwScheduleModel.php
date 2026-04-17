<?php

namespace App\Models;

use CodeIgniter\Model;

class PmwScheduleModel extends Model
{
    protected $table            = 'pmw_schedules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'period_id',
        'phase_number',
        'phase_name',
        'start_date',
        'end_date',
        'description',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'period_id'    => 'required|integer',
        'phase_number' => 'required|integer|greater_than[0]|less_than[13]',
        'phase_name'   => 'required|max_length[100]',
        'start_date'   => 'permit_empty|valid_date',
        'end_date'     => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [
        'period_id' => [
            'required' => 'Periode wajib dipilih',
        ],
        'phase_number' => [
            'required'    => 'Nomor tahap wajib diisi',
            'greater_than' => 'Nomor tahap tidak valid',
            'less_than'    => 'Nomor tahap tidak valid (max 12)',
        ],
        'phase_name' => [
            'required'   => 'Nama tahap wajib diisi',
            'max_length' => 'Nama tahap maksimal 100 karakter',
        ],
    ];

    /**
     * Get schedules by period ID
     */
    public function getByPeriodId(int $periodId): array
    {
        return $this->where('period_id', $periodId)
                    ->orderBy('phase_number', 'ASC')
                    ->findAll();
    }

    /**
     * Get schedule by period and phase number
     */
    public function getByPeriodAndPhase(int $periodId, int $phaseNumber): ?array
    {
        return $this->where('period_id', $periodId)
                    ->where('phase_number', $phaseNumber)
                    ->first();
    }

    /**
     * Create default schedules for a new period
     */
    public function createDefaultSchedules(int $periodId): void
    {
        $defaultPhases = [
            1  => 'Pendaftaran & Submit Proposal',
            2  => 'Seleksi Administrasi',
            3  => 'Pitching Desk',
            4  => 'Wawancara Perjanjian',
            5  => 'Pengumuman Kelolosan Dana PMW Tahap I',
            6  => 'Pembekalan',
            7  => 'Implementasi, Bimbingan & Mentoring',
            8  => 'Monev Tahap 1 (Bazaar)',
            9  => 'Monev Tahap 2 (Site Visit)',
            10 => 'Pengumuman Tahap II',
            11 => 'Laporan Akhir & Penutupan',
            12 => 'Awarding & Expo',
        ];

        foreach ($defaultPhases as $number => $name) {
            $this->insert([
                'period_id'    => $periodId,
                'phase_number' => $number,
                'phase_name'   => $name,
                'start_date'   => null,
                'end_date'     => null,
                'description'  => null,
                'is_active'    => true,
            ]);
        }
    }

    /**
     * Get active schedules for current period
     */
    public function getActiveSchedules(int $periodId): array
    {
        return $this->where('period_id', $periodId)
                    ->where('is_active', true)
                    ->orderBy('phase_number', 'ASC')
                    ->findAll();
    }
}
