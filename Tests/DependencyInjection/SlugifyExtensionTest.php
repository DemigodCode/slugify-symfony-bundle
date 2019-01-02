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
use Cocur\SlugifySymfonyBundle\Twig\SlugifyExtension as TwigSlugifyExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

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
    
    /**
     * @var ContainerBuilder
     */
    protected $container;
    
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new SlugifyExtension();
    }

    /**
     * @test
     * @covers Cocur\SlugifySymfonyBundle\DependencyInjection\SlugifyExtension::load()
     */
    public function load()
    {
        $this->extension->load([['default' => []]], $this->container);
        
        // Check for slugify service registration and all it's legacy aliases
        $this->assertTrue($this->container->hasDefinition(Slugify::class));
        $this->assertTrue($this->container->hasAlias(SlugifyInterface::class));
        $this->assertTrue($this->container->hasAlias('slugify'));
        $this->assertTrue($this->container->hasAlias('cocur_slugify'));
        
        $this->assertTwigExtensionRegistration($this->container);
        
    }
    
    /**
     * @test
     * @covers Cocur\SlugifySymfonyBundle\DependencyInjection\SlugifyExtension::load()
     */
    public function loadWithoutTwigExtension()
    {
        $this->extension->load([['register_twig_service' => false]], $this->container);
        
        $this->assertTrue($this->container->hasDefinition(Slugify::class));
        $this->assertFalse($this->container->hasDefinition(TwigSlugifyExtension::class));      
    }
    
    /**
     * Asserts the correct registration of the twig extension with all its aliases
     * @param ContainerBuilder $container
     */
    private function assertTwigExtensionRegistration(ContainerBuilder $container) {
        // Check for Twig Extension and legacy service id
        $this->assertTrue($this->container->hasDefinition(TwigSlugifyExtension::class));
        $this->assertTrue($this->container->hasAlias('cocur_slugify.twig.slugify'));
        
        // Check for correct constructor argument and twig.extension tag
        $twigExtensionargument = $container->getDefinition(TwigSlugifyExtension::class)->getArgument(0);
        $this->assertInstanceOf(Reference::class, $twigExtensionargument);
        $this->assertEquals(Slugify::class, (string) $twigExtensionargument);
        $this->assertTrue($this->container->getDefinition(TwigSlugifyExtension::class)->hasTag('twig.extension'));
        $this->assertEquals(TwigSlugifyExtension::class, (string)$this->container->getAlias('cocur_slugify.twig.slugify'));
    }
}
