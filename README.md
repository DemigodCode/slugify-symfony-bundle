cocur/slugify-symfony-bundle
=============

> Converts a string into a slug.

[![Build Status](https://img.shields.io/travis/DemigodCode/slugify-symfony-bundle.svg?style=flat)](https://travis-ci.org/cocur/slugify-symfony-bundle)
[![Windows Build status](https://ci.appveyor.com/api/projects/status/9yv498ff61byp742?svg=true)](https://ci.appveyor.com/project/florianeckerstorfer/slugify-symfony-bundle)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/cocur/slugify-symfony-bundle.svg?style=flat)]((https://scrutinizer-ci.com/g/DemigodCode/slugify-symfony-bundle/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/DemigodCode/slugify-symfony-bundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/cocur/slugify-symfony-bundle/?branch=master)

[![Latest Release](https://img.shields.io/packagist/v/DemigodCode/slugify-symfony-bundle.svg)](https://packagist.org/packages/cocur/slugify-symfony-bundle)
[![MIT License](https://img.shields.io/packagist/l/DemigodCode/slugify-symfony-bundle.svg)](http://opensource.org/licenses/MIT)
[![Total Downloads](https://img.shields.io/packagist/dt/DemigodCode/slugify-symfony-bundle.svg)](https://packagist.org/packages/cocur/slugify-symfony-bundle)

This bundle provides a integration to symfony as bundle, without dependencies to other framworks.

Developed by Benedikt Lenzen in Aachen, Europe with the help of
[many great contributors](https://github.com/DemigodCode/slugify-symfony-bundle/graphs/contributors).


Installation
------------

You can install Slugify through [Composer](https://getcomposer.org):

```shell
$ composer require cocur/slugify-symfony-bundle
```

Slugify requires the Multibyte String extension from PHP. Typically you can use the configure option `--enable-mbstring` while compiling PHP. More information can be found in the [PHP documentation](http://php.net/manual/en/mbstring.installation.php).

You only need to add the bundle class
to your `AppKernel.php`:

```php
# app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Cocur\SlugifySymfonyBundle\SlugifyBundle(),
        );
        // ...
    }

    // ...
}
```

You can now use the `cocur_slugify` service everywhere in your application, for example, in your controller:

```php
$slug = $this->get('cocur_slugify')->slugify('Hello World!');
```

The bundle also provides an alias `slugify` for the `cocur_slugify` service:

```php
$slug = $this->get('slugify')->slugify('Hello World!');
```

If you use `autowire` (Symfony >=3.3), you can inject it into your services like this:

```php
public function __construct(\Cocur\Slugify\SlugifyInterface $slugify)
```

You can set the following configuration settings in `config.yml` to adjust the slugify service:

```yaml
cocur_slugify_bundle:
    default:
        lowercase: <boolean>
        separator: <string>
        regexp: <string>
        rulesets: { } # List of rulesets: https://github.com/cocur/slugify/tree/master/Resources/rules
```

Usage
-----

For general usage of cocur/slugify please see [here](https://github.com/cocur/slugify/).

### Further information

- [API docs](http://cocur.co/slugify-symfony-bundle/api/master/)

Change Log
----------

Authors
-------

- [Benedikt Lenzen](https://github.com/DemigodCode)
- And many [great contributors](https://github.com/cocur/slugify-symfony-bundle/graphs/contributors)

License
-------

The MIT License (MIT)

Copyright (c) 2018 Benedikt Lenzen

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
