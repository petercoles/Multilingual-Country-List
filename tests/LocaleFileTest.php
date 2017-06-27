<?php

class LocaleFileTest extends \PHPUnit_Framework_TestCase
{
    protected $maker;
        
    public function setUp()
    {
        $this->maker = new PeterColes\Countries\Maker;
    }

    public function testLocaleFileExists()
    {
        $lookup = $this->maker->lookup('fr');

        $this->assertInstanceOf(Illuminate\Support\Collection::class, $lookup);
    }

    public function testDefaultLocaleFileExists()
    {
        $lookup = $this->maker->lookup(null);

        $this->assertInstanceOf(Illuminate\Support\Collection::class, $lookup);
    }

    public function testLocaleFileDoesNotExist()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Locale: <foo> not recognised.');

        $lookup = $this->maker->lookup('foo');
    }
}
