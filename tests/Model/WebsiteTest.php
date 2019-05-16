<?php

namespace TM\Tests;


use PHPUnit\Framework\TestCase;
use TM\Model\Website;

/**
 * Class WebsiteTest
 * @package TM\Tests
 */
class WebsiteTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInstantiateObject()
    {
        $expectedHost = 'www.example.com';
        $expectedName = 'Example.com';
        $expectedPages = [
            'index.html',
            'catalog',
            'catalog?page=2'
        ];

        $website = new Website($expectedHost, $expectedPages);

        $this->assertInstanceOf(Website::class, $website);
        $this->assertEquals($expectedHost, $website->getHost());
        $this->assertEquals($expectedName, $website->getName());
        $this->assertEquals($expectedPages, $website->getPages());
    }
}