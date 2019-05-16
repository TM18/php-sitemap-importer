<?php

namespace TM;

use SimpleXMLElement;
use TM\Exception\SitemapImporterException;
use TM\Model\Website;

/**
 * Class SitemapImporter
 * @package TM
 */
class SitemapImporter
{
    /**
     * @var SimpleXMLElement|null
     */
    private $xml;

    /**
     * SitemapImporter constructor.
     * @param SimpleXMLElement $xml
     */
    public function __construct(?SimpleXMLElement $xml = null)
    {
        $this->xml = $xml;
    }

    /**
     * Loads and parses XML file
     *
     * @param string $path
     */
    public function loadFile(string $path): void
    {
        $this->xml = simplexml_load_file($path);
    }

    /**
     * Returns array of websites included in sitemap.
     *
     * @return array
     * @throws SitemapImporterException
     */
    public function getWebsites(): array
    {
        $this->validateXml();
        $websites = $this->extractWebsites();

        return $this->mapToModel($websites);
    }

    /**
     * @throws SitemapImporterException
     */
    private function validateXml(): void
    {
        if (!$this->xml) {
            throw new SitemapImporterException('Error parsing XML file.');
        }

        if (empty($this->xml->url)) {
            throw new SitemapImporterException('Provided XML file is not valid sitemap file.');
        }
    }

    /**
     * @return array
     */
    private function extractWebsites(): array
    {
        if (is_null($this->xml)) {
            return [];
        }

        $websites = [];

        foreach ($this->xml->url as $url) {
            if (empty($url->loc)) {
                continue;
            }

            $parsed = parse_url($url->loc);

            if (!isset($parsed['host'])) {
                continue;
            }

            if ($parsed['path'] != '/') {
                $parsed['path'] = substr($parsed['path'], 1, strlen($parsed['path']) - 1);
            }

            $websites[$parsed['host']][] = $parsed['path'] . isset($parsed['query']) ?: '';
        }

        return $websites;
    }

    /**
     * @param array $websites
     * @return array
     */
    private function mapToModel(array $websites): array
    {
        $mapped = [];
        foreach ($websites as $host => $pages) {
            $mapped[] = new Website($host, $pages);
        }

        return $mapped;
    }
}