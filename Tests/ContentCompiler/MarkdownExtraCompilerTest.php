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

use Cocur\Bundle\PageBundle\ContentCompiler\MarkdownExtraCompiler;

/**
 * MarkdownExtraCompilerTest
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
class MarkdownExtraCompilerTest extends \PHPUnit_Framework_TestCase
{
    /** @var MarkdownExtraCompiler */
    private $compiler;

    public function setUp()
    {
        $this->compiler = new MarkdownExtraCompiler();
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\MarkdownExtraCompiler::compile()
     */
    public function compileShouldCompilePlainTextIntoHtml()
    {
        $this->assertEquals("<p><strong>foo</strong></p>\n", $this->compiler->compile("**foo**"));
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\ContentCompiler\MarkdownExtraCompiler::getFormats()
     */
    public function getFormatsShouldReturnFormats()
    {
        $this->assertContains('mdx', $this->compiler->getFormats());
    }
}
