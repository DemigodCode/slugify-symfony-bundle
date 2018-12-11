<?php

/*
 * This file is part of the cocur/slugify-symfony-bundle package.
 *
 * (c) Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\SlugifySymfonyBundle\Tests\DependencyInjection;

use Cocur\SlugifySymfonyBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

/**
 * ConfigurationTest
 *
 * @author     Benedikt Lenzen <benedikt.lenzen@bl-websolutions.de>
 * @copyright  2018
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 */
class ConfigurationTest extends TestCase {

    public function testAll() {
        $configs = [
            [
                'default' => [
                    'lowercase' => true,
                    'lowercase_after_regexp' => false,
                    'strip_tags' => false,
                    'separator' => '_',
                    'regexp' => 'abcd',
                    'rulesets' => ['burmese', 'hindi']
                ],
            ]
        ];

        $this->process($configs);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidTypeException
     */
    public function testLowercaseOnlyAcceptsBoolean() {
        $configs = [['default' => ['lowercase' => 'abc']]];
        $this->process($configs);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidTypeException
     */
    public function testLowercaseAfterRegexpOnlyAcceptsBoolean() {
        $configs = [['default' => ['lowercase_after_regexp' => 'abc']]];
        $this->process($configs);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidTypeException
     */
    public function testStripTagsOnlyAcceptsBoolean() {
        $configs = [['default' => ['strip_tags' => 'abc']]];
        $this->process($configs);
    }

    /**
     * Processes an array of configurations and returns a compiled version.
     *
     * @param array $configs An array of raw configurations
     *
     * @return array A normalized array
     */
    protected function process($configs) {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), $configs);
    }

}
