<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @package    cocur/blog-bundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 *
 * @codeCoverageIgnore
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('cocur_blog')
            ->children()
                ->arrayNode('storage')
                    ->children()
                        ->scalarNode('base_path')->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
