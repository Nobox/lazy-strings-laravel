# Lazy Strings for Laravel

Laravel 5 service provider for LazyStrings.

[![Build Status](https://travis-ci.org/Nobox/lazy-strings-laravel.svg?branch=1.0)](https://travis-ci.org/Nobox/lazy-strings-laravel)

## Installation
Add Lazy Strings to your composer.json file.

```bash
composer require nobox/lazy-strings-laravel
```

## Laravel versions
Here's a rundown on the version(s) of lazy strings that you can use on your current installed laravel version.

| Laravel version     | Service Provider version to use    |
| ------------------- | ---------------------------------- |
| 5.0                 | `1.0.*`                            |
| 5.1                 | `1.1.*`                            |

## Register Lazy Strings
Register Lazy Strings service provider in the `providers` array located in `config/app.php`
```php
'providers' => [
    Nobox\LazyStrings\LazyStringsServiceProvider::class,
]
```

## Publish configuration and assets
This package uses some basic configuration and pretty CSS and JS from bootstrap.
```bash
php artisan vendor:publish
```

## Configuration
Configuration is pretty simple, each configuration item is described below. More details on how these work can be found in the Lazy Strings repo [here](https://github.com/Nobox/Lazy-Strings).

- `csv-url` Add the Google spreadsheet published url.
```php
'csv-url' => 'http://docs.google.com/spreadsheets/d/1V_cHt5Fe4x9XwVepvlXB39sqKXD3xs_QbM-NppkrE4A/export?format=csv'
```

- `target-folder` This folder will be in your `storage` folder and it just saves a backup of your strings in `JSON` format. By default is `lazy-strings`.
```php
'target-folder' => 'lazy-strings'
```

- `strings-route` This is the route that will be used to generate the strings. Visit `http://my-app.com/lazy/build-copy` and your strings will be updated. By default is `build-copy`. The route will always be under the `lazy` prefix.
```php
'strings-route' => 'build-copy'
```

- `nested` Whether or not you wish your generated strings array to be nested.
```php
'nested' => true,
```

- `sheets` Here you'll specify all the sheets in your Google doc.
```php
'sheets' => [
    'en' => [0, 1626663029],
    'es' => 1329731586,
    'pt' => 1443604037
]
```

## How it works
Lazy Strings uses an `id => value` convention to access the copy, it generates an `lazy.php` file inside the language locale folder. You can see an example doc here: https://docs.google.com/a/nobox.com/spreadsheets/d/1V_cHt5Fe4x9XwVepvlXB39sqKXD3xs_QbM-NppkrE4A/edit#gid=0.

| id            | value         |
| ------------- | ------------- |
| foo           | Hello!        |
| lazy          | LazyStrings   |
| laravel       | PHP Framework |

In this doc you can access the first row in your view like this:
```php
trans('lazy.foo') // returns "Hello!"
```

Or in your controller like this:
```php
Lang::get('lazy.foo'); // returns "Hello!"
```

## Generate your strings
Each time you need to generate your strings just visit the specified `strings-route` in your configuration. The route will always be under the `lazy` prefix. For example: `http://my-app.com/lazy/build-copy`

You can also use the included artisan command `php artisan lazy:deploy`. It will do exactly the same. This is perfect when you're deploying your application with Forge or Envoyer.

## License
MIT
