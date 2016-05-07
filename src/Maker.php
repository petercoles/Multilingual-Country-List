<?php

namespace PeterColes\Countries;

class Maker
{
    protected $countries = null;

    public function lookup($locale = 'en', $flip = false)
    {
        $this->prep($locale);

        if ($flip) {
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
            return (object) [ $key => $index, $value =>$item ];
        })->values(); 
    }

    protected function prep($locale)
    {
        $locale = $locale ?: 'en';
        $this->countries = collect(require realpath(__DIR__."/../data/$locale.php"));             
    }
}
