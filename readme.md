# Country Codes for Laravel

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/petercoles/Countries/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Countries/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/petercoles/Countries/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Countries/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/petercoles/Countries/badges/build.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Countries/build-status/master)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

## Introduction

I've lost count of the number of time that I've carefully edited a list of 250 of so countries to create the data needed for a select field on a form. This thin Laravel wrapper around the awesome country-list package, consigns that tedious task to history.

ISO 3166 http://www.iso.org/iso/country_codes

## Installation

At the command line run

```
composer require petercoles/countries
```

then add the service provider to the providers entry in your config/app.php file

```
    'providers' => [
        // ...
        PeterColes\LiveOrLetDie\Providers\CountriesServiceProvider::class,
        // ...
    ],
```

## Usage





## Issues

This package was developed to meet a specific need and then generalised for wider use. If you have a use case not currently met, or see something that appears to not be working correctly, please raise an issue at the [github repo](https://github.com/petercoles/countries/issues)

## License

This package is licensed under the [MIT license](http://opensource.org/licenses/MIT).
