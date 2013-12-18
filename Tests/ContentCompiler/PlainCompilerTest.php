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

use Cocur\Bundle\PageBundle\ContentCompiler\PlainCompiler;

/**
 * PlainCompilerTest
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
class PlainCompilerTest extends \PHPUnit_Framework_TestCase
{
    /** @var PlainCompiler */
    private $compiler;

    public function setUp()
    {
        $this->compiler = new PlainCompiler();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\PlainCompiler::compile()
     */
    public function compileShouldCompilePlainTextIntoHtml()
    {
        $this->assertEquals("foo<br />\nbar", $this->compiler->compile("foo\nbar"));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\PlainCompiler::getFormats()
     */
    public function getFormatsShouldReturnFormats()
    {
        $this->assertContains('txt', $this->compiler->getFormats());
    }
}
