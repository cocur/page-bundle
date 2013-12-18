<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\FmParser;

/**
 * FmParserFactory
 *
 * @package    cocur/page-bundle
 * @subpackage FmParser
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class FmParserFactory
{
    /** @var FmParserInterface[] */
    private $parsers = [];

    /**
     * Adds a parser for the given format.
     *
     * @param FmParserInterface $parser Parser.
     * @param string            $format Format this parser can handle.
     *
     * @return FmParserFactory
     */
    public function add(FmParserInterface $parser, $format = null)
    {
        if (null === $format) {
            $format = $parser->getFormat();
        }

        $this->parsers[$format] = $parser;

        return $this;
    }

    /**
     * Returns if a parser for the given format exists.
     *
     * @param string $format Format to parse.
     *
     * @return boolean `true` if a parser for the given format exists, `false` otherwise.
     */
    public function has($format)
    {
        return isset($this->parsers[$format]);
    }

    /**
     * Returns the parser for the given format.
     *
     * @param string $format Format to parse.
     *
     * @return FmParserInterface
     */
    public function get($format)
    {
        return $this->parsers[$format];
    }
}
