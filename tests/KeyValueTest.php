<?php

class KeyValueTest extends \PHPUnit_Framework_TestCase
{
    protected $maker;
        
    public function setUp()
    {
        $this->maker = new PeterColes\Countries\Maker;
    }

    public function testDefaultSettings()
    {
        $keyValue = $this->maker->keyValue();

        $this->assertEquals(255, $keyValue->count());
        $this->assertEquals((object)[ 'key' => 'AF', 'value' => 'Afghanistan' ], $keyValue->first());
    }

    public function testAlternativeLocale()
    {
        $keyValue = $this->maker->keyValue('es');

        $this->assertEquals((object)[ 'key' => 'AF', 'value' => 'Afganistán' ], $keyValue->first());
    }

    public function testAlternativeKeys()
    {
        $keyValue = $this->maker->keyValue(null, 'label', 'text');

        $this->assertEquals((object)[ 'label' => 'ZW', 'text' => 'Zimbabwe' ], $keyValue->last());
    }
}
