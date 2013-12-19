<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Tests\Content;

use Cocur\Bundle\PageBundle\Content\Content;

/**
 * ContentTest
 *
 * @category   Test
 * @package    cocur/page-bundle
 * @subpackage Content
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 * @group      unit
 */
class ContentTest extends \PHPUnit_Framework_TestCase
{
    /** @var Content */
    private $content;

    public function setUp()
    {
        $this->content = new Content();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\Content::setOptions()
     * @covers Cocur\Bundle\PageBundle\Content\Content::getOptions()
     */
    public function setOptionsShouldSetOptions()
    {
        $this->content->setOptions([ 'key' => 'value' ]);
        $this->assertEquals([ 'key' => 'value', 'title' => null ], $this->content->getOptions());
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\Content::hasOption()
     */
    public function hasOptionShouldReturnIfOptionExists()
    {
        $this->content->setOptions([ 'key' => 'value' ]);
        $this->assertTrue($this->content->hasOption('key'));
        $this->assertFalse($this->content->hasOption('invalid'));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\Content::getOption()
     */
    public function getOptionShouldReturnOptionValue()
    {
        $this->content->setOptions([ 'key' => 'value' ]);
        $this->assertEquals('value', $this->content->getOption('key'));
        $this->assertNull($this->content->getOption('invalid'));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\Content::setFormat()
     * @covers Cocur\Bundle\PageBundle\Content\Content::getFormat()
     */
    public function setFormatShouldSetFormat()
    {
        $this->content->setFormat('md');
        $this->assertEquals('md', $this->content->getFormat());
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\Content::setSource()
     * @covers Cocur\Bundle\PageBundle\Content\Content::getSource()
     */
    public function setSourceShouldSetSource()
    {
        $this->content->setSource('source');
        $this->assertEquals('source', $this->content->getSource());
    }
}
