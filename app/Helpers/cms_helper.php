<?php

use App\Models\CmsContentModel;

/**
 * CMS Helper - Dynamic content management with caching
 */

if (!function_exists('cms')) {
    /**
     * Get CMS content by key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function cms(string $key, $default = '')
    {
        static $cms_data = [];

        // Identify group from key (e.g., galeri_hero_title -> group: galeri_hero)
        $parts = explode('_', $key);
        
        if (count($parts) >= 2) {
            $group = "{$parts[0]}_{$parts[1]}";
        } else {
            $group = $parts[0] ?? 'general';
        }

        // Load group if not loaded
        if (!isset($cms_data[$group])) {
            $cms_data[$group] = cms_group($group);
        }

        $content = $cms_data[$group][$key] ?? null;

        if ($content === null) return $default;

        // Auto-decode JSON if type is json
        // Note: In our implementation, we'll store the type in the group fetch
        // but for simplicity, we check if it's a valid JSON string
        if (is_string($content) && (str_starts_with($content, '[') || str_starts_with($content, '{'))) {
            $decoded = json_decode($content, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return $content;
    }
}

if (!function_exists('cms_group')) {
    /**
     * Get all CMS content for a specific group (with caching)
     * 
     * @param string $group
     * @return array
     */
    function cms_group(string $group): array
    {
        $cacheKey = "cms_group_{$group}";
        $data = cache($cacheKey);

        if ($data === null) {
            $model = new CmsContentModel();
            $results = $model->getByGroup($group);
            
            $data = [];
            foreach ($results as $row) {
                $data[$row['key']] = $row['content'];
            }

            // Cache for 24 hours (86400 seconds)
            // It will be invalidated when admin updates content
            cache()->save($cacheKey, $data, 86400);
        }

        return $data;
    }
}

if (!function_exists('cms_img')) {
    /**
     * Get CMS image URL (handles external URL or secure internal path)
     * 
     * @param string|null $path
     * @param string $default
     * @return string
     */
    function cms_img($path, $default = '')
    {
        if (empty($path)) return $default;

        // If it's a full URL, return as is
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        // Otherwise, it's a secure path in WRITEPATH/uploads/cms
        // We serve it via AdminController::viewCmsImage
        return base_url('admin/cms/image/' . basename($path));
    }
}
