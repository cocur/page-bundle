<?php

/**
 * This file is part of cocur/page-bundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Content;

/**
 * Content
 *
 * @package    cocur/page-bundle
 * @subpackage Content
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class Content
{
    /** @var array */
    private $options = [
        'title' => null
    ];

    /** @var string */
    private $format;

    /** @var string */
    private $source;

    /**
     * @param array $options
     *
     * @return Content
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);

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
     * Returns if the option with the given name exists.
     *
     * @param string $name Name of an option.
     *
     * @return boolean `true` if the option exists, `false` otherwise.
     */
    public function hasOption($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * Returns the option with the given name.
     *
     * @param string $name Name of an option.
     *
     * @return mixed Value of the option, `null` if the option does not exist.
     */
    public function getOption($name)
    {
        if (false === $this->hasOption($name)) {
            return null;
        }

        return $this->options[$name];
    }

    /**
     * Sets the format of the source.
     *
     * @param string $format Format of the source.
     *
     * @return Content
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Returns the format of the source.
     *
     * @return string Format of the source.
     */
    public function getFormat()
    {
        return $this->format;
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
