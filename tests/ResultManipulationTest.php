<?php

use PHPUnit\Framework\TestCase;

class ResultManipulationTest extends TestCase
{
    protected $maker;
        
    public function setUp(): void
    {
        $this->maker = new PeterColes\Countries\Maker;
    }

    public function testAddCountry()
    {
        $lookup = $this->maker->lookup()->put('ZZ', 'My Country')->sort();

        $this->assertEquals('My Country', $lookup['ZZ']);
    }

    public function testRemoveRegions()
    {
        $lookup = $this->maker->lookup()->reject(function($country, $key) {
            return in_array($key, [ 'IC', 'TD' ]);
        });

        $this->assertArrayNotHasKey('IC', $lookup->toArray());
    }

    public function testReplaceKey()
    {
        $lookup = $this->maker->lookup()->mapWithKeys(function($country, $key) {
            return $key == 'GB' ? [ 'UK' => $country ] : [ $key => $country ];
        });

        $this->assertArrayNotHasKey('GB', $lookup->toArray());
        $this->assertEquals('United Kingdom', $lookup['UK']);
    }
}
