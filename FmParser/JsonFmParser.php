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

use Braincrafted\Json\Json;

/**
 * JsonFmParser
 *
 * @package    cocur/blog-bundle
 * @subpackage FmParser
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class JsonFmParser implements FmParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($input)
    {
        return Json::decode($input, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getFormat()
    {
        return 'json';
    }
}
