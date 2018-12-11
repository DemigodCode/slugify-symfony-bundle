<?php

/**
 * This file is part of cocur/slugify-symfony-bundle.
 *
 * (c) Benedikt Lenzen <benedikt.lenzen@bl-websolutions.e>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\SlugifySymfonyBundle\Tests;

use Cocur\SlugifySymfonyBundle\SlugifyBundle;
use Cocur\SlugifySymfonyBundle\DependencyInjection\SlugifyExtension;
use PHPUnit\Framework\TestCase;

/**
 * SlugifyBundleTest
 * @author     Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 * @copyright  2018
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyBundleTest extends TestCase
{
    /**
     * @covers Cocur\SlugifySymfonyBundle\SlugifyBundle::getContainerExtension()
     */
    public function testGetContainerExtension()
    {
        $bundle = new SlugifyBundle();

        static::assertInstanceOf(SlugifyExtension::class, $bundle->getContainerExtension());
    }
}
