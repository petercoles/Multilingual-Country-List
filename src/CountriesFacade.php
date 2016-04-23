<?php

namespace PeterColes\Countries;

use Illuminate\Support\Facades\Facade;

/**
 */
class CountriesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'countries';
    }
}
