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
        $treeBuilder = new TreeBuilder('cocur_slugify_bundle');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('default')
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
            ->end();

        return $treeBuilder;
    }
}
