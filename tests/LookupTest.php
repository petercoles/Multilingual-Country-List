<?php

class LookupTest extends \PHPUnit_Framework_TestCase
{
    protected $maker;
        
    public function setUp()
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
