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

use Cocur\Bundle\PageBundle\ContentCompiler\HtmlCompiler;

/**
 * HtmlCompilerTest
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
class HtmlCompilerTest extends \PHPUnit_Framework_TestCase
{
    /** @var HtmlCompiler */
    private $compiler;

    public function setUp()
    {
        $this->compiler = new HtmlCompiler();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\HtmlCompiler::compile()
     */
    public function compileShouldCompilePlainTextIntoHtml()
    {
        $this->assertEquals("<strong>foo</strong>", $this->compiler->compile("<strong>foo</strong>"));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\HtmlCompiler::getFormats()
     */
    public function getFormatsShouldReturnFormats()
    {
        $this->assertContains('htm', $this->compiler->getFormats());
        $this->assertContains('html', $this->compiler->getFormats());
    }
}
