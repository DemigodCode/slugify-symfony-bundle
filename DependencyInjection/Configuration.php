<?php

/*
 * This file is part of the cocur/slugify-symfony-bundle package.
 *
 * (c) Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\SlugifySymfonyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cocur_slugify');

        $rootNode
            ->children()
                ->arrayNode('default')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('lowercase')->end()
                        ->booleanNode('lowercase_after_regexp')->end()
                        ->booleanNode('trim')->end()
                        ->booleanNode('strip_tags')->end()
                        ->scalarNode('separator')->end()
                        ->scalarNode('regexp')->end()
                        ->arrayNode('rulesets')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
                ->booleanNode('register_twig_service')->defaultTrue()->end()
            ->end();

        return $treeBuilder;
    }
}
