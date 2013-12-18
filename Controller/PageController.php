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

    /**
     * @param Filesystem $filesystem
     * @param string     $basePath
     */
    public function __construct(ContentLoader $contentLoader)
    {
        $this->contentLoader = $contentLoader;
    }

    /**
     * @param string $key
     *
     * @return Response
     */
    public function pageAction($key)
    {
        $content = $this->contentLoader->load($key);

        return new Response($content->getSource());
    }
}
