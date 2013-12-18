<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * FmParserPass
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
class FmParserPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('cocur_blog.fm_parser_factory')) {
            return;
        }

        $definition = $container->getDefinition('cocur_blog.fm_parser_factory');

        foreach ($container->findTaggedServiceIds('cocur.fm_parser') as $id => $attributes) {
            $definition->addMethodCall('add', [ new Reference($id) ]);
        }
    }
}