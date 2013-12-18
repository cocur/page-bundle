<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Cocur\Bundle\BlogBundle\DependencyInjection\Compiler\FmParserPass;

/**
 * CocurBlogBundle
 *
 * @package   cocur/blog-bundle
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cocur.florian.ec Cocur Website
 *
 * @codeCoverageIgnore
 */
class CocurBlogBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FmParserPass());
    }
}
