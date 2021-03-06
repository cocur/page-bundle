<?php

/**
 * This file is part of cocur/page-bundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\ContentCompiler;

use Michelf\Markdown;

/**
 * MarkdownCompiler
 *
 * @package    cocur/page-bundle
 * @subpackage ContentCompiler
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class MarkdownCompiler implements CompilerInterface
{
    /**
     * {@inheritDoc}
     */
    public function compile($input)
    {
        return Markdown::defaultTransform($input);
    }

    /**
     * {@inheritDoc}
     */
    public function getFormats()
    {
        return [ 'md', 'markdown' ];
    }
}
