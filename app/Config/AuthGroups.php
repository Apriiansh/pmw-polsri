<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'mahasiswa';

    public array $groups = [
        'admin' => [
            'title'       => 'Administrator',
            'description' => 'PMW System Administrator with full oversight.',
        ],
        'mahasiswa' => [
            'title'       => 'Mahasiswa',
            'description' => 'Student participants of the PMW program.',
        ],
        'dosen' => [
            'title'       => 'Dosen Pembimbing',
            'description' => 'Faculty supervisors for student teams.',
        ],
        'mentor' => [
            'title'       => 'Mentor',
            'description' => 'External business mentors.',
        ],
        'reviewer' => [
            'title'       => 'Reviewer',
            'description' => 'Assessors for proposal and report quality.',
        ],
    ];

    public array $permissions = [
        'admin.access'        => 'Can access the main admin dashboard',
        'admin.manage'        => 'Can manage users and system settings',
        'data.upload'         => 'Can upload documents (Proposal, Laporan, Nota)',
        'data.mentoring'      => 'Can record mentoring activities',
        'data.verify'         => 'Can verify/sign-off mentoring logs',
        'data.assess'         => 'Can assess/score proposals and reports',
        'data.view_all'       => 'Can view all student data',
    ];

    public array $matrix = [
        'admin' => [
            'admin.*',
            'data.*',
        ],
        'mahasiswa' => [
            'data.upload',
            'data.mentoring',
        ],
        'dosen' => [
            'data.verify',
            'data.view_all',
        ],
        'mentor' => [
            'data.verify',
            'data.view_all',
        ],
        'reviewer' => [
            'data.assess',
            'data.view_all',
        ],
    ];

}
