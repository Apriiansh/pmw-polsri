<?php

// Load CI4 environment
require_once '/home/apriiansh/Projects/polsri/PMW/app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
$cache = \Config\Services::cache();

echo "Updating CMS groups...\n";

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
    
    echo "Updated group $group\n";
    $cache->delete("cms_group_$group");
}

// Also clear the 'home' group cache which was likely polluted
$cache->delete("cms_group_home");

echo "Done!\n";
