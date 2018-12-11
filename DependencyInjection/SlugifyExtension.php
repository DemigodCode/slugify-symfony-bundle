<?php

/**
 * This file is part of cocur/slugify-symfony-bundle.
 *
 * (c) Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\SlugifySymfonyBundle\DependencyInjection;

use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;
use Cocur\SlugifySymfonyBundle\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * SlugifyExtension
 * @author     Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 * @copyright  2018
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyExtension extends Extension
{
    /**
     * {@inheritDoc}
     *
     * @param mixed[]          $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (empty($config['default']['rulesets'])) {
            unset($config['default']['rulesets']);
        }

        // Extract slugify arguments from config
        $slugifyArguments = array_intersect_key($config['default'], array_flip(['lowercase', 'trim', 'strip_tags', 'separator', 'regexp', 'rulesets']));

        $container->setDefinition(Slugify::class, new Definition(Slugify::class, [$slugifyArguments]));
        $container
            ->setDefinition(
                'cocur_slugify.twig.slugify',
                new Definition(
                    'Cocur\Slugify\Bridge\Twig\SlugifyExtension',
                    [new Reference('cocur_slugify')]
                )
            )
            ->addTag('twig.extension')
            ->setPublic(false);
        $container->setAlias('cocur_slugify', Slugify::class);
        $container->setAlias('slugify', Slugify::class);
        $container->setAlias(SlugifyInterface::class, Slugify::class);
    }

}
