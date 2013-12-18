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

/**
 * CompilerInterface
 *
 * @package    cocur/page-bundle
 * @subpackage ContentCompiler
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
*/
interface CompilerInterface
{
    /**
     * Compiles the given input into HTML code.
     *
     * @param string $source Input
     *
     * @return string Compiled HTML code
     */
    public function compile($input);

    /**
     * Returns the formats the compiler can handle.
     *
     * @return string[] Formats the compiler can handle.
     */
    public function getFormats();
}
