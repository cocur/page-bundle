<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

use Cocur\Bundle\PageBundle\Content\ContentLoader;
use Cocur\Bundle\PageBundle\Content\Content;
use Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection;
use Cocur\Bundle\PageBundle\ContentCompiler\CompilerInterface;
use Cocur\Bundle\PageBundle\Event\PostCompileEvent;
use Cocur\Bundle\PageBundle\Event\PostLoadEvent;
use Cocur\Bundle\PageBundle\Event\PostRenderEvent;
use Cocur\Bundle\PageBundle\Event\PreCompileEvent;
use Cocur\Bundle\PageBundle\Event\PreLoadEvent;
use Cocur\Bundle\PageBundle\Event\PreRenderEvent;

/**
 * PageController
 *
 * @package    cocur/page-bundle
 * @subpackage Controller
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class PageController
{
    /** @var ContentLoader */
    private $contentLoader;

    /** @var CompilerCollection */
    private $compilers;

    /** @var string */
    private $templating;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /**
     * Constructor.
     *
     * @param ContentLoader            $contentLoader
     * @param CompilerCollection       $compilers
     * @param EngineInterface          $templating
     * @param EventDispatcherInterface $dispatcher
     *
     * @codeCoverageIgnore
     */
    public function __construct(
        ContentLoader $contentLoader,
        CompilerCollection $compilers,
        EngineInterface $templating,
        EventDispatcherInterface $dispatcher
    ) {
        $this->contentLoader = $contentLoader;
        $this->compilers     = $compilers;
        $this->templating    = $templating;
        $this->dispatcher    = $dispatcher;
    }

    /**
     * @param string $key
     *
     * @return Response
     */
    public function pageAction($key)
    {
        $content = $this->load($key);

        $compiler = $this->compilers->get($content->getFormat());

        if (null === $compiler) {
            throw new \RuntimeException(
                sprintf('Could not find compiler for source in "%s" format.', $content->getFormat())
            );
        }

        return $this->render($this->compile($compiler, $content));
    }

    /**
     * Loads the content with the given key.
     *
     * @param string $key Key of the content.
     *
     * @return Cocur\Bundle\PageBundle\Content\Content
     */
    protected function load($key)
    {
        $event = new PreLoadEvent($key);
        $this->dispatcher->dispatch('cocur_page.pre_load', $event);

        $content = $this->contentLoader->load($event->getKey());

        $event = new PostLoadEvent($content);
        $this->dispatcher->dispatch('cocur_page.post_load', $event);

        return $event->getContent();
    }

    /**
     * Compiles the content.
     *
     * @param CompilerInterface $compiler Content compiler
     * @param Content           $content  Content
     *
     * @return array Compiled variables
     */
    protected function compile(CompilerInterface $compiler, Content $content)
    {
        $event = new PreCompileEvent($content);
        $this->dispatcher->dispatch('cocur_page.pre_compile', $event);
        $content = $event->getContent();

        $vars = $content->getOptions();
        $vars['content'] = $compiler->compile($content->getSource());

        $event = new PostCompileEvent($vars);
        $this->dispatcher->dispatch('cocur_page.post_compile', $event);

        return $event->getVars();
    }

    protected function render(array $vars)
    {
        $event = new PreRenderEvent($vars);
        $this->dispatcher->dispatch('cocur_page.pre_render', $event);
        $vars = $event->getVars();

        $response = $this->templating->renderResponse(
            sprintf('%s.html.twig', isset($vars['layout']) ? $vars['layout'] : 'CocurPageBundle:Layout:default'),
            $vars
        );

        $event = new PostRenderEvent($response);
        $this->dispatcher->dispatch('cocur_page.post_render', $event);

        return $event->getResponse();
    }
}
