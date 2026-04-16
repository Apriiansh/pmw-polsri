<?php

namespace App\Models;

use CodeIgniter\Model;

class PmwDocumentModel extends Model
{
    protected $table            = 'pmw_documents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'team_id',
        'proposal_id',
        'uploader_id',
        'type',
        'doc_key',
        'file_path',
        'original_name',
        'status',
        'version',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProposalDocs(int $proposalId): array
    {
        return $this->where('proposal_id', $proposalId)
            ->findAll();
    }

    public function getProposalDocByKey(int $proposalId, string $docKey): ?array
    {
        return $this->where('proposal_id', $proposalId)
            ->where('doc_key', $docKey)
            ->first();
    }
}
