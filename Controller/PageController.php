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

use Symfony\Component\HttpFoundation\Response;

use Cocur\Bundle\PageBundle\Content\ContentLoader;
use Cocur\Bundle\PageBundle\ContentCompiler\CompilerCollection;

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

    /**
     * @param Filesystem $filesystem
     * @param string     $basePath
     */
    public function __construct(ContentLoader $contentLoader, CompilerCollection $compilers)
    {
        $this->contentLoader = $contentLoader;
        $this->compilers = $compilers;
    }

    /**
     * @param string $key
     *
     * @return Response
     */
    public function pageAction($key)
    {
        $content = $this->contentLoader->load($key);
        $compiler = $this->compilers->get($content->getFormat());

        if (null === $compiler) {
            throw new \RuntimeException(
                sprintf('Could not find compiler for source in "%s" format.', $content->getFormat())
            );
        }

        return new Response($compiler->compile($content->getSource()));
    }
}
