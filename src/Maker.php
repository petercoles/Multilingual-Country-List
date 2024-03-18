<?php

namespace PeterColes\Countries;

use Exception;

class Maker
{
    protected $countries = [];

    public function lookup($locale = 'en', $flip = false)
    {
        $this->prep($locale);

        if ($flip) {
            return $this->countries[$locale]->flip();
        }

        return $this->countries[$locale];
    }

    public function keyValue($locale = 'en', $key = 'key', $value = 'value')
    {
        $this->prep($locale);

        $key = $key ?: 'key';
        $value = $value ?: 'value';

        return $this->countries[$locale]->transform(function($item, $index) use ($key, $value) {
            return (object) [ $key => $index, $value =>$item ];
        })->values(); 
    }

    public function countryName($isoCode, $locale = 'en')
    {
        $this->prep($locale);

        $isoCode = strtoupper($isoCode);

        if (!$this->countries->has($isoCode)) {
            throw new Exception("No country name found for ISO code: $isoCode and locale: $locale.");
        }

        return $this->countries->get($isoCode);
    }

    protected function prep($locale)
    {
        if (array_key_exists($locale, $this->countries)) {
            return;
        }
        
        $locale = $locale ?: 'en';
        $localeFile = realpath(__DIR__."/../data/$locale.php");

        if (!file_exists($localeFile)) {
            throw new Exception("Locale: <$locale> not recognised.");
        }

        $this->countries = collect(require $localeFile);
    }
}
