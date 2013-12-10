<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\Controller;

use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\Response;

/**
 * PageController
 *
 * @package    cocur/blog-bundle
 * @subpackage Controller
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class PageController
{
    /** @var Filesystem */
    private $filesystem;

    /** @var string */
    private $basePath;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem, $basePath)
    {
        $this->filesystem = $filesystem;
        $this->basePath   = $basePath;
    }

    /**
     * @param string $filename
     *
     * @return Response
     */
    public function pageAction($filename)
    {
        $pathname = sprintf('%s/%s', $this->basePath, $filename);

        if (false === $this->filesystem->has($pathname)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not exist.', $pathname));
        }

        return new Response($this->filesystem->get($pathname)->getContent());
    }
}
