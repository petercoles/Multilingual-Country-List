# Multilingual Country Lists for Laravel

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/18292467-2547-461a-89bc-c0f77a1be286/mini.png)](https://insight.sensiolabs.com/projects/18292467-2547-461a-89bc-c0f77a1be286)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/petercoles/Multilingual-Country-List/?branch=master)
[![Build Status](https://travis-ci.org/petercoles/Multilingual-Country-List.svg?branch=master)](https://travis-ci.org/petercoles/Multilingual-Country-List)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

## Introduction

I've lost count of the number of times that I've carefully edited a list of 250 of so countries to create the data needed for a select field on a form - and that's just for one language. This thin Laravel wrapper around an industry-maintained list of country names in many, many languages, consigns that tedious task and ongoing maintenance of those lists to the trash bin of history.

The package provides easy access, through a simple API, to country names in an enormously large number of language and locale settings, together with their ISO-3166 alpha-2 two-letter country codes.

Data can be returned as a lookup array or an array of key-value pairs, where both the key and value labels can be set according to the needs of the software consuming them.

## Installation

At the command line run

```shell
composer require petercoles/multilingual-country-list
```

If you're using Laravel 5.5 or later (and haven't disabled package discovery), you're done. Move on to the usage section below.

If you're using an older version of Laravel, then add the service provider to the providers entry in your config/app.php file

```php
    'providers' => [
        // ...
        PeterColes\Countries\CountriesServiceProvider::class,
        // ...
    ],
```

An optional facade is also available and can be enabled by adding the following to the aliases array in your config/app.php file.

```php
'Countries' => PeterColes\Countries\CountriesFacade::class,
```

## Usage

Once installed the package exposes two API methods: lookup() and keyValue(), each of which returns a list of countries ordered by the country name in the language being used.

### Lookup

The ```lookup``` method takes two optional parameters: $locale (default 'en') and $flip (default false) and returns a collection. This collection will be cast to a json object by Laravel if returned as a response, or can be cast to an array if needed with the toArray() method.

Locales can be expressed as a language code, e.g. 'fr', or a full locale code, e.g. zh_CN.

#### Lookup Examples

The default is English.

```php
Countries::lookup();

// returns

{
  "AF": "Afghanistan",
  ...
  "ZW": "Zimbabwe"
}

```

The flip parameter facilitates reverse lookups, e.g. for typahead components that recognize values, but don't support keys, requiring the key to obtained later.

```php
Countries::lookup('es', true);

// returns

{  
  "Afganistán": "AF",
  ...
  "Zimbabue": "ZW"
}

```

Non-latin character sets are supported too, including locale settings

```php
Countries::lookup('zh_CN');

// returns

{
  "AL": "阿尔巴尼亚",
  ...
  "HK": "中国香港特别行政区"
}

```

### keyValue

The ```keyValue``` method takes three optional parameters: $locale (default 'en'), $key (default 'key') and $value (default 'value').

#### Key Value Examples

The default is still English.

```php
Countries::keyValue();

// returns

[
  {"key": "AF", "value": "Afghanistan"},
  ...
  {"key": "ZW", "value": "Zimbabwe"}
]
```

If you need a key-value list with custom indices, then the $key and $value parameters can be used to redfine them. this might be the case, for example, if you're using a javascript component to generate a select field and that component has expectations as to the indices used in the data that it receoves.

```php
Countries::keyValue('zh', 'label', 'text');

// returns

[
  {"label": "AL", "text": "阿尔巴尼亚"},
  ...
  {"label": "HK", "text": "中国香港特别行政区"}
]
```

### Tweaking

So, you've got a list of countries, but it doesn't quite meet your needs. Since the lookup and keyValue methods return Laravel collections, tweaking the results is super easy.

#### Filtering

The data from which these lists are drawn includes "Eurozone" and, despite some politicans wishes, that's not really a country. Let's remove it.

```php
Countries::lookup()->reject(function($country, $key) {
    return $key == 'EZ';
});
```

There are also some entries that may be considered parts of other countries. Without getting into the politics, let's also remove the Canary Islands (Spain) and Guadeloupe (France).

```php
Countries::lookup()->reject(function($country, $key) {
    return in_array($key, [ 'EZ', 'IC', 'GP' ]);
});
```

#### Modifying

Also, we know that the international code for the United Kingdom is "GB", but our payment gateway is expecteding "UK". So lets change that.

```php
Countries::lookup()->mapWithKeys(function($country, $key) {
    return $key == 'GB' ? [ 'UK' => $country ] : [ $key => $country ];
});
```

#### Adding

The number of recognized countries is growing, but not always as fast as changes on the ground, so, with no comment on the political rights and wrongs, let's add a new one.

```php
Countries::lookup()->put('CT', 'Catalonia')->sort();
```

A few warnings here:

* Do check that the code isn't being already.
* Do remember to sort the list after making the addition.
* Don't forget to keep checking the list so that you can remove your addition if it becomes official.

## Issues

This package was developed to meet a specific need and then generalised for wider use. If you have a use case not currently met, or see something that appears to not be working correctly, please raise an issue at the [github repo](https://github.com/petercoles/countries/issues).

## License

This package is licensed under the [MIT license](http://opensource.org/licenses/MIT).
