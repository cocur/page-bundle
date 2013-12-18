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

use \Mockery as m;

use Cocur\Bundle\PageBundle\FmParser\FmParserFactory;

/**
 * FmParserFactoryTest
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
class FmParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var FmParserFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new FmParserFactory();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\FmParser\FmParserFactory::add()
     * @covers Cocur\Bundle\PageBundle\FmParser\FmParserFactory::has()
     * @covers Cocur\Bundle\PageBundle\FmParser\FmParserFactory::get()
     */
    public function addShouldAddParserToFactory()
    {
        $parser = m::mock('Cocur\Bundle\PageBundle\FmParser\FmParserInterface');

        $this->factory->add($parser, 'foo');

        $this->assertTrue($this->factory->has('foo'));
        $this->assertEquals($parser, $this->factory->get('foo'));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\FmParser\FmParserFactory::add()
     * @covers Cocur\Bundle\PageBundle\FmParser\FmParserFactory::has()
     * @covers Cocur\Bundle\PageBundle\FmParser\FmParserFactory::get()
     */
    public function addShouldGetFormatFromParser()
    {
        $parser = m::mock('Cocur\Bundle\PageBundle\FmParser\FmParserInterface');
        $parser->shouldReceive('getFormat')->withNoArgs()->once()->andReturn('foo');

        $this->factory->add($parser);

        $this->assertTrue($this->factory->has('foo'));
        $this->assertEquals($parser, $this->factory->get('foo'));
    }
}
