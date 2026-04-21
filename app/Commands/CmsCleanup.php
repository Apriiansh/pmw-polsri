<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CmsCleanup extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'cms:cleanup';
    protected $description = 'Cleanup orphan CMS keys not present in the Seeder.';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        
        // Define the keys we WANT to keep (from the seeder)
        $validKeys = [
            'home_hero_badge', 'home_hero_title', 'home_hero_description', 'home_hero_image', 'home_hero_stats',
            'home_features_badge', 'home_features_title', 'home_features_description', 'home_features_list',
            'home_workflow_badge', 'home_workflow_title', 'home_workflow_description', 'home_workflow_image', 'home_workflow_list',
            'home_gallery_badge', 'home_gallery_title', 'home_gallery_description',
            'home_stats_list',
            'home_announcement_badge', 'home_announcement_title', 'home_announcement_description',
            'home_cta_badge', 'home_cta_title', 'home_cta_description', 'home_cta_button',
            'tahapan_hero_badge', 'tahapan_hero_title', 'tahapan_hero_description', 'tahapan_hero_image',
            'tahapan_flow_badge', 'tahapan_flow_title', 'tahapan_flow_description', 'tahapan_flow_image', 'tahapan_flow_list',
            'tahapan_cta_title', 'tahapan_cta_description', 'tahapan_cta_button',
            'tentang_hero_badge', 'tentang_hero_title', 'tentang_hero_description', 'tentang_hero_image',
            'tentang_vision_badge', 'tentang_vision_title', 'tentang_vision_description', 'tentang_vision_image',
            'tentang_objectives_badge', 'tentang_objectives_title', 'tentang_objectives_description', 'tentang_objectives_list',
            'tentang_cta_title', 'tentang_cta_description', 'tentang_cta_button',
            'pengumuman_hero_badge', 'pengumuman_hero_title', 'pengumuman_hero_description'
        ];

        $allRows = $db->table('cms_content')->select('key')->get()->getResultArray();
        $orphanKeys = [];

        foreach ($allRows as $row) {
            if (!in_array($row['key'], $validKeys)) {
                $orphanKeys[] = $row['key'];
            }
        }

        if (empty($orphanKeys)) {
            CLI::write('No orphan keys found.', 'green');
            return;
        }

        CLI::write('Found orphan keys:', 'yellow');
        foreach ($orphanKeys as $key) {
            CLI::write("- $key");
        }

        if (CLI::prompt('Delete these keys?', ['y', 'n']) === 'y') {
            $db->table('cms_content')->whereIn('key', $orphanKeys)->delete();
            CLI::write('Orphan keys deleted successfully.', 'green');
        }
    }
}
