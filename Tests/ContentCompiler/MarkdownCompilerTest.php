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

use Cocur\Bundle\PageBundle\ContentCompiler\MarkdownCompiler;

/**
 * MarkdownCompilerTest
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
class MarkdownCompilerTest extends \PHPUnit_Framework_TestCase
{
    /** @var MarkdownCompiler */
    private $compiler;

    public function setUp()
    {
        $this->compiler = new MarkdownCompiler();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\MarkdownCompiler::compile()
     */
    public function compileShouldCompilePlainTextIntoHtml()
    {
        $this->assertEquals("<p><strong>foo</strong></p>\n", $this->compiler->compile("**foo**"));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\MarkdownCompiler::getFormats()
     */
    public function getFormatsShouldReturnFormats()
    {
        $this->assertContains('md', $this->compiler->getFormats());
        $this->assertContains('markdown', $this->compiler->getFormats());
    }
}
