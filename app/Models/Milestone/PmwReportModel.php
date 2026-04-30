<?php

namespace App\Models\Milestone;

use CodeIgniter\Model;

class PmwReportModel extends Model
{
    protected $table            = 'pmw_reports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'schedule_id',
        'type',
        'file_path',
        'notes',
        'status',
        'dosen_note',
        'dosen_verified_at',
        'submitted_at'
    ];

    protected $validationRules = [
        'proposal_id' => 'required|integer',
        'schedule_id' => 'required|integer',
        'type'        => 'required|in_list[kemajuan,akhir,magang]',
        'file_path'   => 'required|string',
        'notes'       => 'permit_empty|string',
        'status'      => 'required|in_list[submitted,approved,rejected,revision]',
        'dosen_note'  => 'permit_empty|string',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get report by proposal and type
     */
    public function getReportByProposal($proposalId, $type)
    {
        return $this->where('proposal_id', $proposalId)
                    ->where('type', $type)
                    ->first();
    }
}
