<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Sitemap extends BaseController
{
    public function index(): ResponseInterface
    {
        $urls = [
            ['loc' => base_url(), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => base_url('tentang'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => base_url('tahapan'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => base_url('galeri'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => base_url('pengumuman'), 'priority' => '0.9', 'changefreq' => 'daily'],
        ];

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($urls as $url) {
            $node = $xml->addChild('url');
            $node->addChild('loc', $url['loc']);
            $node->addChild('priority', $url['priority']);
            $node->addChild('changefreq', $url['changefreq']);
            $node->addChild('lastmod', date('Y-m-d'));
        }

        return $this->response
            ->setHeader('Content-Type', 'text/xml')
            ->setBody($xml->asXML());
    }
}
