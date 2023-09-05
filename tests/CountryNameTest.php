<?php

use PHPUnit\Framework\TestCase;

class CountryNameTest extends TestCase
{
    protected $maker;
        
    public function setUp(): void
    {
        $this->maker = new PeterColes\Countries\Maker;
    }

    public function testDefaultSettings()
    {
        $countryName = $this->maker->countryName('BE');

        $this->assertEquals('Belgium', $countryName);
    }

    public function testLocaleSetting()
    {
        $countryName = $this->maker->countryName('BE', 'fr');

        $this->assertEquals('Belgique', $countryName);
    }

    public function testHandlesLowerCaseIsoCode()
    {
        $countryName = $this->maker->countryName('be', 'fr');

        $this->assertEquals('Belgique', $countryName);
    }

    public function testHandlesInvalidIsoCode()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('No country name found for ISO code: ZZ and locale: fr.');

        $countryName = $this->maker->countryName('ZZ', 'fr');
    }
}
