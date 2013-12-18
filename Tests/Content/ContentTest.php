<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\Tests\Content;

use Cocur\Bundle\BlogBundle\Content\Content;

/**
 * ContentTest
 *
 * @category   Test
 * @package    cocur/blog-bundle
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
     * @covers Cocur\Bundle\BlogBundle\Content\Content::setOptions()
     * @covers Cocur\Bundle\BlogBundle\Content\Content::getOptions()
     */
    public function setOptionsShouldSetOptions()
    {
        $this->content->setOptions([ 'key' => 'value' ]);
        $this->assertEquals([ 'key' => 'value' ], $this->content->getOptions());
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\BlogBundle\Content\Content::setSource()
     * @covers Cocur\Bundle\BlogBundle\Content\Content::getSource()
     */
    public function setSourceShouldSetSource()
    {
        $this->content->setSource('source');
        $this->assertEquals('source', $this->content->getSource());
    }
}
