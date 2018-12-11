Migration from cocur/slugify to cocur/slugify-symfony-bundle
=============

Adapt the Bundle Registration
--------

* Change the registered Bridge into the cocur/slugify-symfony-bundle in your AppKernel.php

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

Adapt the bundle config
--------

* Add a new node between your current configuration
* Rename cocur_slugify to cocur_slugify_bundle

```yaml
cocur_slugify_bundle:
    default:
        lowercase: <boolean>
        separator: <string>
        regexp: <string>
        rulesets: { } # List of rulesets: https://github.com/cocur/slugify/tree/master/Resources/rules
```