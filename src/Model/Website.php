<?php

namespace TM\Model;

/**
 * Class Website
 * @package TM\Model
 */
class Website
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $pages;

    /**
     * Website constructor.
     * @param string $host
     * @param array $pages
     */
    public function __construct(string $host, array $pages)
    {
        $this->host = $host;
        $this->pages = $pages;
        $this->name = $this->extractName($host);
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @param string $host
     * @return string
     */
    private function extractName(string $host): string
    {
        return ucwords(preg_replace('/www./', '', $host));
    }
}