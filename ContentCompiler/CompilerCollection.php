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
 * CompilerCollection
 *
 * @package    cocur/page-bundle
 * @subpackage ContentCompiler
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class CompilerCollection
{
    /** @var CompilerInterface[] */
    private $compilers = [];

    /**
     * Adds a compiler to the collection.
     *
     * @param CompilerInterface $compiler Compiler.
     *
     * @return CompilerCollection
     */
    public function add(CompilerInterface $compiler)
    {
        $this->compilers[] = $compiler;

        return $this;
    }

    /**
     * Returns if a compiler for the given format exists.
     *
     * @param string $needle Format to check if a compiler exists.
     *
     * @return boolean `true` if a compiler exists, `false` otherwise
     */
    public function has($needle)
    {
        foreach ($this->compilers as $compiler) {
            if (true === in_array($needle, $compiler->getFormats())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the compiler for the given format.
     *
     * @param string $needle Format to return a compiler for.
     *
     * @return CompilerInterface Compiler for the given format or `null` if no compiler exists.
     */
    public function get($needle)
    {
        foreach ($this->compilers as $compiler) {
            if (true === in_array($needle, $compiler->getFormats())) {
                return $compiler;
            }
        }

        return null;
    }
}
