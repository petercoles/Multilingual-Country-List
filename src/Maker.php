<?php

namespace PeterColes\Countries;

use Exception;

class Maker
{
    protected $countries = null;

    public function lookup($locale = 'en', $reverse = false)
    {
        $this->prep($locale);

        if ($reverse) {
            return $this->countries->flip();
        }

        return $this->countries;
    }

    public function keyValue($locale = 'en', $key = 'key', $value = 'value')
    {
        $this->prep($locale);

        $key = $key ?: 'key';
        $value = $value ?: 'value';

        return $this->countries->transform(function($item, $index) use ($key, $value) {
            return (object) [$key => $index, $value =>$item];
        })->values(); 
    }

    protected function prep($locale)
    {
        if (!$this->countries) {
            $locale = $locale ?: 'en';
            $path = base_path("vendor/umpirsky/country-list/data/$locale/country.json");
            $this->countries = collect(json_decode(file_get_contents($path)));
        }
    }
}
