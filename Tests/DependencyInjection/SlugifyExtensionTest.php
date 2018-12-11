<?php

/**
 * This file is part of cocur/slugify-symfony-bundle.
 *
 * (c) Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\SlugifySymfonyBundle\Tests\DependencyInjection;

use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;
use Cocur\SlugifySymfonyBundle\DependencyInjection\SlugifyExtension;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * SlugifyExtensionTest
 *
 * @author     Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 * @copyright  2018
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyExtensionTest extends TestCase
{
    /**
     *
     * @var SlugifyExtension 
     */
    protected $extension;
    
    protected function setUp()
    {
        $this->extension = new SlugifyExtension();
    }

    /**
     * @test
     * @covers Cocur\SlugifySymfonyBundle\DependencyInjection\SlugifyExtension::load()
     */
    public function load()
    {
        $twigDefinition = m::mock('Symfony\Component\DependencyInjection\Definition');
        $twigDefinition
            ->shouldReceive('addTag')
            ->with('twig.extension')
            ->once()
            ->andReturn($twigDefinition);
        $twigDefinition
            ->shouldReceive('setPublic')
            ->with(false)
            ->once();

        $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $container
            ->shouldReceive('setDefinition')
            ->with(Slugify::class, m::type('Symfony\Component\DependencyInjection\Definition'))
            ->once();
        $container
            ->shouldReceive('setDefinition')
            ->with('cocur_slugify.twig.slugify', m::type('Symfony\Component\DependencyInjection\Definition'))
            ->once()
            ->andReturn($twigDefinition);
        $container
            ->shouldReceive('setAlias')
            ->with('slugify', Slugify::class)
            ->once();
        $container
            ->shouldReceive('setAlias')
            ->with('cocur_slugify', Slugify::class)
            ->once();
        $container
            ->shouldReceive('setAlias')
            ->with(SlugifyInterface::class, Slugify::class)
            ->once();

        $this->extension->load([['default' => []]], $container);
    }
}
