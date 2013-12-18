<?php

/**
 * This file is part of cocur/page-bundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Tests\ContentCompiler;

use \Mockery as m;

use Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection;

/**
 * CompilerCollectionTest
 *
 * @category   Test
 * @package    cocur/page-bundle
 * @subpackage ContentCompiler
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 * @group      unit
 */
class CompilerCollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var CompilerCollection */
    private $collection;

    public function setUp()
    {
        $this->collection = new CompilerCollection();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection::add()
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection::has()
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection::get()
     */
    public function addShouldAddCompiler()
    {
        $compiler = m::mock('Cocur\Bundle\PageBundle\ContentCompiler\CompilerInterface');
        $compiler->shouldReceive('getFormats')->twice()->andReturn([ 'foo' ]);

        $this->collection->add($compiler);
        $this->assertTrue($this->collection->has('foo'));
        $this->assertEquals($compiler, $this->collection->get('foo'));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection::has()
     */
    public function hasShouldReturnFalseWhenNoCompilerExists()
    {
        $this->assertFalse($this->collection->has('invalid'));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection::get()
     */
    public function getShouldReturnNullWhenNoCompilerExists()
    {
        $this->assertNull($this->collection->get('invalid'));
    }
}
