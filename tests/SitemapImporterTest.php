<?php

namespace TM\Tests;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;
use TM\Exception\SitemapImporterException;
use TM\Model\Website;
use TM\SitemapImporter;
use TM\Tests\Traits\InvalidSitemapTrait;
use TM\Tests\Traits\InvalidXmlTrait;
use TM\Tests\Traits\SitemapTrait;

/**
 * Class SitemapImporterTest
 * @package TM\Tests
 */
class SitemapImporterTest extends TestCase
{
    use InvalidSitemapTrait;
    use InvalidXmlTrait;
    use SitemapTrait;

    /**
     * @test
     */
    public function shouldInstantiateObject()
    {
        $importer = new SitemapImporter();

        $this->assertInstanceOf(SitemapImporter::class, $importer);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenFileIsInvalid()
    {
        $importer = new SitemapImporter($this->getInvalidXmlTrait());
        $this->expectException(SitemapImporterException::class);
        $importer->getWebsites();
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenFileIsNotSitemap()
    {
        $importer = new SitemapImporter($this->getInvalidSitemapTrait());
        $this->expectException(SitemapImporterException::class);
        $importer->getWebsites();
    }

    /**
     * @test
     *
     * @dataProvider sitemapsProvider
     * @param SimpleXMLElement $xml
     * @param int $expectedWebsitesCount
     * @param array $expectedPagesCount
     * @throws SitemapImporterException
     */
    public function shouldLoadWebsitesAndPages(SimpleXMLElement $xml, int $expectedWebsitesCount, array $expectedPagesCount)
    {
        $importer = new SitemapImporter($xml);
        $websites = $importer->getWebsites();

        /** @var Website $website */
        foreach ($websites as $i => $website) {
            $this->assertInstanceOf(Website::class, $website);
            $this->assertCount($expectedPagesCount[$i], $website->getPages());
        }

        $this->assertCount($expectedWebsitesCount, $websites);
    }

    /**
     * @return array
     */
    public function sitemapsProvider(): array
    {
        return [
            [$this->getSitemapWithOnePageTrait(), 1, [1]],
            [$this->getSitemapWithManyPagesTrait(), 2, [3, 2]]
        ];
    }
}