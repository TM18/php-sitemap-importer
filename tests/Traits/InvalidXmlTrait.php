<?php

namespace TM\Tests\Traits;

use SimpleXMLElement;

/**
 * Trait InvalidXmlTrait
 * @package TM\Tests\Traits
 */
trait InvalidXmlTrait
{
    /**
     * @var string
     */
    private $invalidXml = ' <invalid> <loc>http://www.example.com/</loc> <lastmod>2005-01-01</lastmod> <changefreq>monthly</changefreq> <priority>0.8</priority> </invalid>';

    /**
     * @return SimpleXMLElement
     */
    protected function getInvalidXmlTrait(): SimpleXMLElement
    {
        return new SimpleXMLElement($this->invalidXml);
    }
}