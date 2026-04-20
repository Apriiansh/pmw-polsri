<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixCmsGroupsMigration extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        
        $mappings = [
            'home_hero'          => 'home_hero_%',
            'home_features'      => 'home_features_%',
            'home_workflow'      => 'home_workflow_%',
            'home_gallery'       => 'home_gallery_%',
            'home_announcements' => 'home_announcement_%',
            'home_cta'           => 'home_cta_%',
        ];

        foreach ($mappings as $group => $pattern) {
            $db->table('cms_content')
               ->where('key LIKE', $pattern)
               ->update(['group' => $group]);
        }
        
        // Clear all cache
        cache()->clean();
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $db->table('cms_content')->update(['group' => 'home']);
    }
}
