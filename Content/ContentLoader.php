<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Content;

use Gaufrette\Filesystem;

use Cocur\Bundle\PageBundle\Exception\FileNotExistsException;
use Cocur\Bundle\PageBundle\FmParser\FmParserFactory;

/**
 * ContentLoader
 *
 * @package    cocur/page-bundle
 * @subpackage Content
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class ContentLoader
{
    /** @var string */
    private $defaultFmFormat = 'yaml';

    /** @var Filesystem */
    private $filesystem;

    /** @var string */
    private $basePath;

    /** @var FmParserFactory */
    private $fmParserFactory;

    /**
     * Constructor.
     *
     * @param Filesystem      $filesystem
     * @param string          $basePath
     * @param FmParserFactory $fmParserFactory
     *
     * @codeCoverageIgnore
     */
    public function __construct(Filesystem $filesystem, $basePath, FmParserFactory $fmParserFactory)
    {
        $this->filesystem      = $filesystem;
        $this->basePath        = $basePath;
        $this->fmParserFactory = $fmParserFactory;
    }

    /**
     * Loads the content with the given key.
     *
     * @param string $key Key of the file.
     *
     * @return Content
     */
    public function load($key)
    {
        $pathname = $this->getPathname($key);
        if (false === $this->filesystem->has($pathname)) {
            throw new FileNotExistsException(sprintf('The file "%s" does not exist.', $pathname));
        }
        $lines = explode("\n", $this->filesystem->read($pathname));

        $file = new Content();
        $file->setOptions($this->getOptions($lines));
        $file->setSource($this->getSource($lines));

        return $file;
    }

    /**
     * Returns the pathname of given key.
     *
     * @param string $key Key to build pathname for.
     *
     * @return string Pathname of given key.
     */
    protected function getPathname($key)
    {
        return sprintf('%s/%s', $this->basePath, $key);
    }

    /**
     * Extracts the front matter from the given lines, parses it and returns the options as array.
     *
     * @param string[] $lines Lines of the read content file.
     *
     * @return array Parses options.
     */
    protected function getOptions(array $lines)
    {
        $frontMatter = null;

        if (true === isset($lines[0]) && '---' === substr($lines[0], 0, 3)) {
            $format = trim(substr($lines[0], 3));
            for ($i = 1; $i < count($lines); $i++) {
                if ('---' === $lines[$i]) {
                    break;
                }
                $frontMatter .= $lines[$i]."\n";
            }

            if (0 === strlen($format)) {
                $format = $this->defaultFmFormat;
            }

            if (false === $this->fmParserFactory->has($format)) {
                throw new \RuntimeException(
                    sprintf('There is no parser to handle a front matter in "%s" format.', $format)
                );
            }

            return $this->fmParserFactory->get($format)->parse($frontMatter);
        }

        return [];
    }

    /**
     * Returns the source of the given lines.
     *
     * @param string[] $lines Lines of the read content file.
     *
     * @return string Source.
     */
    protected function getSource(array $lines)
    {
        $i = 0;

        if (true === isset($lines[0]) && '---' === substr($lines[0], 0, 3)) {
            array_shift($lines);
            for ($i = 1; $i < count($lines); $i++) {
                if ('---' === trim($lines[$i])) {
                    $i++;
                    break;
                }
            }
        }

        $source = null;
        for ($i = $i; $i < count($lines); $i++) {
            $source .= $lines[$i]."\n";
        }

        return $source;
    }
}
