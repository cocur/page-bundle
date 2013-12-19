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

    /** @var Symfony\Component\EventDispatcher\EventDispatcherInterface */
    private $dispatcher;

    public function setUp()
    {
        $this->contentLoader = m::mock('Cocur\Bundle\PageBundle\Content\ContentLoader');
        $this->compilers     = m::mock('Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection');
        $this->templating    = m::mock('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface');
        $this->dispatcher    = m::mock('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        $this->controller = new PageController(
            $this->contentLoader,
            $this->compilers,
            $this->templating,
            $this->dispatcher
        );
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::pageAction()
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::load()
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::compile()
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::render()
     */
    public function pageActionShouldRenderPage()
    {
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.pre_load', m::any())->once();
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.post_load', m::any())->once();
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.pre_compile', m::any())->once();
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.post_compile', m::any())->once();
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.pre_render', m::any())->once();
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.post_render', m::any())->once();

        $content = m::mock('Cocur\Bundle\PageBundle\Content\Content');
        $content->shouldReceive('getFormat')->once()->andReturn('md');
        $content->shouldReceive('getOptions')->once()->andReturn([ 'title' => null, 'layout' => 'default' ]);
        $content->shouldReceive('getSource')->once()->andReturn('Hello World!');

        $this->contentLoader->shouldReceive('load')->with('file.md')->once()->andReturn($content);

        $compiler = m::mock('Cocur\Bundle\PageBundle\ContentCompiler\CompilerInterface');
        $compiler->shouldReceive('compile')->with('Hello World!')->once()->andReturn('Hello World!');

        $this->compilers->shouldReceive('get')->with('md')->once()->andReturn($compiler);

        $respone = $this->templating
            ->shouldReceive('renderResponse')
            ->with('default.html.twig', [ 'title' => null, 'content' => 'Hello World!', 'layout' => 'default' ])
            ->once()
            ->andReturn('<body>Hello World!</body>');

        $response = $this->controller->pageAction('file.md');
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::pageAction()
     * @covers Cocur\Bundle\PageBundle\Controller\PageController::load()
     *
     * @expectedException \RuntimeException
     */
    public function pageActionShouldThrowExceptionIfNoCompilerExists()
    {
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.pre_load', m::any())->once();
        $this->dispatcher->shouldReceive('dispatch')->with('cocur_page.post_load', m::any())->once();

        $content = m::mock('Cocur\Bundle\PageBundle\Content\Content');
        $content->shouldReceive('getFormat')->twice()->andReturn('invalid');

        $this->contentLoader->shouldReceive('load')->with('file.md')->once()->andReturn($content);

        $this->compilers->shouldReceive('get')->with('invalid')->once()->andReturn(null);

        $this->controller->pageAction('file.md');
    }
}
