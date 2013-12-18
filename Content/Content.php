<?php

/**
 * This file is part of cocur/blog-bundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\Content;

/**
 * Content
 *
 * @package    cocur/blog-bundle
 * @subpackage Content
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class Content
{
    /** @var array */
    private $options;

    /** @var string */
    private $source;

    /**
     * @param array $options
     *
     * @return Content
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $source
     *
     * @return Content
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Content
     */
    public function getSource()
    {
        return $this->source;
    }
}
