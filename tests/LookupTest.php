<?php

use PHPUnit\Framework\TestCase;

class LookupTest extends TestCase
{
    protected $maker;
        
    public function setUp(): void
    {
        $this->maker = new PeterColes\Countries\Maker;
    }

    public function testDefaultSettings()
    {
        $lookup = $this->maker->lookup();

        $this->assertEquals('Antarctica', $lookup['AQ']);
    }

    public function testLocaleSetting()
    {
        $lookup = $this->maker->lookup('fr');

        $this->assertEquals('Antarctique', $lookup['AQ']);
    }

    public function testReverseSetting()
    {
        $lookup = $this->maker->lookup(null, 'true');

        $this->assertEquals('AQ', $lookup['Antarctica']);
    }
}
