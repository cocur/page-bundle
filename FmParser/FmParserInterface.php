<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\FmParser;

/**
 * FmParserInterface
 *
 * @package    cocur/blog-bundle
 * @subpackage FmParser
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
*/
interface FmParserInterface
{
    /**
     * Parses the given input and returns an array.
     *
     * @param string $input
     *
     * @return array
     */
    public function parse($input);

    /**
     * Returns the format the parser can handle
     *
     * @return string Format the parser can handle
     */
    public function getFormat();
}
