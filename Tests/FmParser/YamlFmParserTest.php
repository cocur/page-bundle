<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Tests\FmParser;

use Cocur\Bundle\PageBundle\FmParser\YamlFmParser;

/**
 * YamlFmParserTest
 *
 * @category   Test
 * @package    cocur/page-bundle
 * @subpackage FmParser
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 * @group      unit
 */
class YamlFmParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var YamlFmParser */
    private $parser;

    public function setUp()
    {
        $this->parser = new YamlFmParser();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\FmParser\YamlFmParser::parse()
     */
    public function parseShouldParseYamlFm()
    {
        $result = $this->parser->parse("foo: bar");
        $this->assertEquals('bar', $result['foo']);
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\FmParser\YamlFmParser::getFormat()
     */
    public function getFormatShouldReturnFormat()
    {
        $this->assertEquals('yaml', $this->parser->getFormat());
    }
}
