<?php

namespace Cocur\Bundle\PageBundle\Tests\Controller;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Controller\PageController;

/**
 * PageControllerTest
 *
 * @group unit
 */
class PageControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var PageController */
    private $controller;

    /** @var Cocur\Bundle\PageBundle\Content\ContentLoader */
    private $contentLoader;

    /** @var Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection */
    private $compilers;

    /** @var Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    public function setUp()
    {
        $this->contentLoader = m::mock('Cocur\Bundle\PageBundle\Content\ContentLoader');
        $this->compilers     = m::mock('Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection');
        $this->templating    = m::mock('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface');

        $this->controller = new PageController(
            $this->contentLoader,
            $this->compilers,
            $this->templating
        );
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::pageAction()
     */
    public function pageActionShouldRenderPage()
    {
        $content = m::mock('Cocur\Bundle\PageBundle\Content\Content');
        $content->shouldReceive('getFormat')->once()->andReturn('md');
        $content->shouldReceive('getOptions')->once()->andReturn([ 'title' => null ]);
        $content->shouldReceive('getSource')->once()->andReturn('Hello World!');
        $content->shouldReceive('hasOption')->once()->andReturn(true);
        $content->shouldReceive('getOption')->once()->andReturn('default');

        $this->contentLoader->shouldReceive('load')->with('file.md')->once()->andReturn($content);

        $compiler = m::mock('Cocur\Bundle\PageBundle\ContentCompiler\CompilerInterface');
        $compiler->shouldReceive('compile')->with('Hello World!')->once()->andReturn('Hello World!');

        $this->compilers->shouldReceive('get')->with('md')->once()->andReturn($compiler);

        $respone = $this->templating
            ->shouldReceive('renderResponse')
            ->with('default.html.twig', [ 'title' => null, 'content' => 'Hello World!'])
            ->once()
            ->andReturn('<body>Hello World!</body>');

        $response = $this->controller->pageAction('file.md');
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::pageAction()
     *
     * @expectedException \RuntimeException
     */
    public function pageActionShouldThrowExceptionIfNoCompilerExists()
    {
        $content = m::mock('Cocur\Bundle\PageBundle\Content\Content');
        $content->shouldReceive('getFormat')->twice()->andReturn('invalid');

        $this->contentLoader->shouldReceive('load')->with('file.md')->once()->andReturn($content);

        $this->compilers->shouldReceive('get')->with('invalid')->once()->andReturn(null);

        $this->controller->pageAction('file.md');
    }
}
