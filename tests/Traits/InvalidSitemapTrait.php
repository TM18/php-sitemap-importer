<?php

namespace TM\Tests\Traits;

use SimpleXMLElement;

/**
 * Trait InvalidSitemapTrait
 * @package TM\Tests\Traits
 */
trait InvalidSitemapTrait
{
    /**
     * @var string
     */
    private $invalidSitemap = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><invalid><loc>http://www.example.com/</loc><lastmod>2005-01-01</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></invalid></urlset>';

    /**
     * @return SimpleXMLElement
     */
    protected function getInvalidSitemapTrait(): SimpleXMLElement
    {
        return new SimpleXMLElement($this->invalidSitemap);
    }
}