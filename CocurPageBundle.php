<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Cocur\Bundle\PageBundle\DependencyInjection\Compiler\ContentCompilerPass;
use Cocur\Bundle\PageBundle\DependencyInjection\Compiler\FmParserPass;

/**
 * CocurPageBundle
 *
 * @package   cocur/page-bundle
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2013 Florian Eckerstorfer
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cocur.florian.ec Cocur Website
 *
 * @codeCoverageIgnore
 */
class CocurPageBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ContentCompilerPass());
        $container->addCompilerPass(new FmParserPass());
    }
}
