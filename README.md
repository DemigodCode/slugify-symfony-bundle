cocur/slugify-symfony-bundle
=============

> Converts a string into a slug.

[![Build Status](https://img.shields.io/travis/cocur/slugify-symfony-bundle.svg?style=flat)](https://travis-ci.org/cocur/slugify-symfony-bundle)
[![Windows Build status](https://ci.appveyor.com/api/projects/status/9yv498ff61byp742?svg=true)](https://ci.appveyor.com/project/florianeckerstorfer/slugify-symfony-bundle)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/cocur/slugify-symfony-bundle.svg?style=flat)](https://scrutinizer-ci.com/g/cocur/slugify-symfony-bundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/cocur/slugify-symfony-bundle/badges/coverage.png?b=master&style=flat-square)](https://scrutinizer-ci.com/g/cocur/slugify-symfony-bundle/?branch=master)

[![Latest Release](https://img.shields.io/packagist/v/cocur/slugify-symfony-bundle.svg)](https://packagist.org/packages/cocur/slugify-symfony-bundle)
[![MIT License](https://img.shields.io/packagist/l/cocur/slugify-symfony-bundle.svg)](http://opensource.org/licenses/MIT)
[![Total Downloads](https://img.shields.io/packagist/dt/cocur/slugify-symfony-bundle.svg)](https://packagist.org/packages/cocur/slugify-symfony-bundle)

Developed by Benedikt Lenzen in Aachen, Europe with the help of
[many great contributors](https://github.com/cocur/slugify-symfony-bundle/graphs/contributors).


Features
--------

- Removes all special characters from a string.
- Provides custom replacements for Arabic, Austrian, Azerbaijani, Brazilian Portuguese, Bulgarian, Burmese, Chinese, Croatian, 
Czech, Esperanto, Estonian, Finnish, French, Georgian, German, Greek, Hindi, Hungarian, Italian, Latvian, Lithuanian, 
Macedonian, Norwegian, Polish, Romanian, Russian, Serbian, Spanish, Swedish, Turkish, Ukrainian and Vietnamese special 
characters. Instead of removing these characters, Slugify approximates them (e.g., `ae` replaces `ä`).
- No external dependencies.
- PSR-4 compatible.
- Compatible with PHP 7


Installation
------------

You can install Slugify through [Composer](https://getcomposer.org):

```shell
$ composer require cocur/slugify-symfony-bundle
```

Slugify requires the Multibyte String extension from PHP. Typically you can use the configure option `--enable-mbstring` while compiling PHP. More information can be found in the [PHP documentation](http://php.net/manual/en/mbstring.installation.php).
 
Slugify contains a Symfony bundle and service definition that allow you to use it as a service in your Symfony
application. The code resides in the `Cocur\Slugify\Bridge\Symfony` namespace and you only need to add the bundle class
to your `AppKernel.php`:

```php
# app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle(),
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
cocur_slugify:
    lowercase: <boolean>
    separator: <string>
    regexp: <string>
    rulesets: { } # List of rulesets: https://github.com/cocur/slugify/tree/master/Resources/rules
```

Usage
-----

Generate a slug:

```php

$slugify = $container->get('cocur_slugify');
echo $slugify->slugify('Hello World!'); // hello-world
```

You can also change the separator used by `Slugify`:

```php
echo $slugify->slugify('Hello World!', '_'); // hello_world
```

The library also contains `Cocur\Slugify\SlugifyInterface`. Use this interface whenever you need to type hint an
instance of `Slugify`.

To add additional transliteration rules you can use the `addRule()` method.

```php
$slugify->addRule('i', 'ey');
echo $slugify->slugify('Hi'); // hey
```

### Rulesets

Many of the transliterations rules used in Slugify are specific to a language. These rules are therefore categorized
using rulesets. Rules for the most popular are activated by default in a specific order. You can change which rulesets
are activated and the order in which they are activated. The order is important when there are conflicting rules in
different languages. For example, in German `ä` is transliterated with `ae`, in Turkish the correct transliteration is
`a`. By default the German transliteration is used since German is used more often on the internet. If you want to use
prefer the Turkish transliteration you have to possibilities. You can activate it after creating the constructor:

```php
$slugify = $container->get('cocur_slugify');
$slugify->slugify('ä'); // -> "ae"
$slugify->activateRuleSet('turkish');
$slugify->slugify('ä'); // -> "a"
```

You can find a list of the available rulesets in [Resources/rules](https://github.com/cocur/slugify/tree/master/Resources/rules).

### More options

By default Slugify will convert the slug to lowercase. If you want to preserve the case of the string you can set the
`lowercase` option to false.

By default Slugify will use dashes as separators. If you want to use a different default separator, you can set the
`separator` option.

By default Slugify will remove leading and trailing separators before returning the slug. If you do not want the slug to 
be trimmed you can set the `trim` option to false.

### Changing options on the fly

You can overwrite any of the above options on the fly by passing an options array as second argument to the `slugify()`
method. For example:

```php
$slugify = $container->get('cocur_slugify');
$slugify->slugify('Hello World', ['lowercase' => false]); // -> "Hello-World"
```

You can also modify the separator this way:

```php
$slugify = $container->get('cocur_slugify');
$slugify->slugify('Hello World', ['separator' => '_']); // -> "hello_world"
```

You can even activate a custom ruleset without touching the default rules:

```php
$slugify = $container->get('cocur_slugify');
$slugify->slugify('für', ['ruleset' => 'turkish']); // -> "fur"
$slugify->slugify('für'); // -> "fuer"
```

### Contributing

Feel free to ask for additional configurations in the issues, but please note that the
maintainer of this repository does not speak all languages. If you can provide a Pull Request that would be amazing.

Submit PR. Thank you very much. 💚

### Code of Conduct

In the interest of fostering an open and welcoming environment, we as contributors and maintainers pledge to making participation in our project and our community a harassment-free experience for everyone, regardless of age, body size, disability, ethnicity, gender identity and expression, level of experience, nationality, personal appearance, race, religion, or sexual identity and orientation.

The full Code of Conduct can be found [here](https://github.com/cocur/slugify/blob/master/CODE_OF_CONDUCT.md).

This project is no place for hate. If you have any problems please contact Florian: [florian@eckerstorfer.net](mailto:florian@eckerstorfer.net) ✌🏻🏳️‍🌈

### Further information

- [API docs](http://cocur.co/slugify-symfony-bundle/api/master/)

Change Log
----------

Authors
-------

- [Benedikt Lenzen](https://github.com/DemigodCode)
- And many [great contributors](https://github.com/cocur/slugify-symfony-bundle/graphs/contributors)

Support
-------

If you need support you can ask on [Twitter](https://twitter.com/cocurco) (well, only if your question is short) or you
can join our chat on Gitter.

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/cocur/slugify)

In case you want to support the development of Slugify we would highly appreciate it if you can send us directly a Pull Request on
Github. If you have never contributed to a project on Github we are happy to help you. Just ask on Twitter or directly
join our Gitter.

You always can help me (Florian, the original developer and maintainer) out by
[sending me an Euro or two](https://paypal.me/florianec/2).


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
