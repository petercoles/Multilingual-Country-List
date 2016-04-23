# Multilingual Country Lists for Laravel

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/?branch=master)
[![Build Status](https://travis-ci.org/petercoles/Multilingual-Country-List.svg?branch=master)](https://travis-ci.org/petercoles/Multilingual-Country-List)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

## Introduction

I've lost count of the number of time that I've carefully edited a list of 250 of so countries to create the data needed for a select field on a form - and that's just for one language. This thin Laravel wrapper around the awesome country-list package, consigns that tedious task to the trash bin of history.

The package provides easy access, through a simple API, to country names in an enormously large number of language and locale settings, together with their ISO-3166 alpha-2 two-letter country codes.

Data can be returned as a lookup array or an array of key-value pairs, where both the key and value labels can be set according to the needs of the software consuming them.

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

An optional facade is also available and can be enabled by adding the following to you config/app.php's aliases array

```
'Countries' => PeterColes\Countries\CountriesFacade::class,
```

## Usage

Once installed the package exposes two API methods: lookup() and keyValue() each of which returns a list of countries ordered by the country name in the language being used.

### Lookup

The lookup method takes two optional parameters: $locale (default 'en') and $flip (default false) and returns a collection. This collection will be cast to a json object by Laravel if returned as a response, or can be cast to an array if needed with the toArray() method.

Locales can be expressed as a language code, e.g. 'fr', or a full locale code, e.g. zh_CN.

#### Examples

The default is English.

```
Countries::lookup();

// returns
{
  "AF": "Afghanistan",
  ...
  "ZW": "Zimbabwe"
}

```

The flip parameter facilitates reverse lookups, e.g. for typahead components that recognize values, but don't support keys.

```
Countries::lookup('es', true);  // default is English

// returns
{  
  "Afganistán": "AF",
  ...
  "Zimbabue": "ZW"
}

```

Non-latin character sets are supported too, including locale settings
```
Countries::lookup('zh_CN');  // default is English

// returns
{
  "AL": "阿尔巴尼亚",
  ...
  "HK": "中国香港特别行政区"
}

```


### keyValue

The keyValue method takes three optional parameters: $locale (default 'en'), $key (default 'key') and $value (default 'value').

#### Examples

The dafault is still English.
```
Countries::keyValue('zh', 'label', 'text');

[
  {"key": "AF", "value": "Afghanistan"},
  ...
  {"key": "HK", "value": "中国香港特别行政区"}
]
```



```
Countries::keyValue('zh', 'label', 'text');

[
  {"label": "AL", "text": "阿尔巴尼亚"},
  ...
  {"label": "HK", "text": "中国香港特别行政区"}
]
```


## Issues

This package was developed to meet a specific need and then generalised for wider use. If you have a use case not currently met, or see something that appears to not be working correctly, please raise an issue at the [github repo](https://github.com/petercoles/countries/issues)

## License

This package is licensed under the [MIT license](http://opensource.org/licenses/MIT).
