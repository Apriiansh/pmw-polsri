<?php

namespace App\Models;

use CodeIgniter\Model;

class PmwPeriodModel extends Model
{
    protected $table            = 'pmw_periods';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name',
        'year',
        'is_active',
        'description',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'name'      => 'required|min_length[3]|max_length[100]',
        'year'      => 'required|integer|greater_than[2000]',
        'is_active' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama periode wajib diisi',
            'min_length' => 'Nama periode minimal 3 karakter',
        ],
        'year' => [
            'required'     => 'Tahun periode wajib diisi',
            'greater_than' => 'Tahun tidak valid',
        ],
    ];

    /**
     * Get active period
     */
    public function getActive(): ?array
    {
        return $this->where('is_active', true)->first();
    }

    /**
     * Deactivate all periods
     */
    public function deactivateAll(): void
    {
        $this->db->query("UPDATE {$this->table} SET is_active = false");
    }

    /**
     * Activate specific period
     */
    public function activate(int $id): bool
    {
        $this->db->transStart();

        // Deactivate all first
        $this->db->query("UPDATE {$this->table} SET is_active = 0");

        // Activate specific period using query builder
        $result = $this->db->query(
            "UPDATE {$this->table} SET is_active = 1 WHERE id = ?",
            [$id]
        );

        $this->db->transComplete();

        return $result !== false;
    }
}
