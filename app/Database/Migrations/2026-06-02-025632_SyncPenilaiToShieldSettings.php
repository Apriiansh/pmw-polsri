<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SyncPenilaiToShieldSettings extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        // 1. Update AuthGroups.groups — tambahkan penilai
        $currentGroups = $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'groups')
            ->get()->getRowArray();

        if ($currentGroups) {
            $groups = json_decode($currentGroups['value'], true) ?? [];
            if (!isset($groups['penilai'])) {
                $groups['penilai'] = [
                    'title'       => 'Penilai',
                    'description' => 'Assessors for pitching desk evaluation.',
                ];
                $db->table('settings')
                    ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                    ->where('key', 'groups')
                    ->update(['value' => json_encode($groups)]);
            }
        } else {
            // Settings table kosong — fallback ke config. Kita insert semua groups dari config + penilai.
            $authGroups = new \Config\AuthGroups();
            $groups = $authGroups->groups;
            $groups['penilai'] = [
                'title'       => 'Penilai',
                'description' => 'Assessors for pitching desk evaluation.',
            ];
            $db->table('settings')->insert([
                'class'       => 'CodeIgniter\Shield\Config\AuthGroups',
                'key'         => 'groups',
                'value'       => json_encode($groups),
                'type'        => 'array',
                'context'     => null,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        // 2. Update AuthGroups.permissions — tambahkan data.pitching_verify
        $currentPerms = $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'permissions')
            ->get()->getRowArray();

        if ($currentPerms) {
            $perms = json_decode($currentPerms['value'], true) ?? [];
            if (!isset($perms['data.pitching_verify'])) {
                $perms['data.pitching_verify'] = 'Can verify/assess pitching desk submissions';
                $db->table('settings')
                    ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                    ->where('key', 'permissions')
                    ->update(['value' => json_encode($perms)]);
            }
        } else {
            $authGroups = new \Config\AuthGroups();
            $perms = $authGroups->permissions;
            $perms['data.pitching_verify'] = 'Can verify/assess pitching desk submissions';
            $db->table('settings')->insert([
                'class'       => 'CodeIgniter\Shield\Config\AuthGroups',
                'key'         => 'permissions',
                'value'       => json_encode($perms),
                'type'        => 'array',
                'context'     => null,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        // 3. Update AuthGroups.matrix — assign permission ke penilai
        $currentMatrix = $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'matrix')
            ->get()->getRowArray();

        if ($currentMatrix) {
            $matrix = json_decode($currentMatrix['value'], true) ?? [];
            if (!isset($matrix['penilai'])) {
                $matrix['penilai'] = [
                    'data.pitching_verify',
                    'data.view_all',
                ];
                $db->table('settings')
                    ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                    ->where('key', 'matrix')
                    ->update(['value' => json_encode($matrix)]);
            }
        } else {
            $authGroups = new \Config\AuthGroups();
            $matrix = $authGroups->matrix;
            $matrix['penilai'] = [
                'data.pitching_verify',
                'data.view_all',
            ];
            $db->table('settings')->insert([
                'class'       => 'CodeIgniter\Shield\Config\AuthGroups',
                'key'         => 'matrix',
                'value'       => json_encode($matrix),
                'type'        => 'array',
                'context'     => null,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();

        // Revert groups
        $currentGroups = $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'groups')
            ->get()->getRowArray();
        if ($currentGroups) {
            $groups = json_decode($currentGroups['value'], true) ?? [];
            unset($groups['penilai']);
            $db->table('settings')
                ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                ->where('key', 'groups')
                ->update(['value' => json_encode($groups)]);
        }

        // Revert permissions
        $currentPerms = $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'permissions')
            ->get()->getRowArray();
        if ($currentPerms) {
            $perms = json_decode($currentPerms['value'], true) ?? [];
            unset($perms['data.pitching_verify']);
            $db->table('settings')
                ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                ->where('key', 'permissions')
                ->update(['value' => json_encode($perms)]);
        }

        // Revert matrix
        $currentMatrix = $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'matrix')
            ->get()->getRowArray();
        if ($currentMatrix) {
            $matrix = json_decode($currentMatrix['value'], true) ?? [];
            unset($matrix['penilai']);
            $db->table('settings')
                ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                ->where('key', 'matrix')
                ->update(['value' => json_encode($matrix)]);
        }
    }
}
