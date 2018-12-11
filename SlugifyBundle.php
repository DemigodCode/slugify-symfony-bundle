<?php

/**
 * This file is part of cocur/slugify.
 *
 * (c) Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\SlugifySymfonyBundle;

use Cocur\SlugifySymfonyBundle\DependencyInjection\SlugifyExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * SlugifyBundle
 * @author     Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 * @copyright  2018
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class SlugifyBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SlugifyExtension();
    }
}
