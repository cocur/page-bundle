<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\Tests\Content;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Content\ContentLoader;

/**
 * ContentLoaderTest
 *
 * @category   Test
 * @package    cocur/page-bundle
 * @subpackage Content
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 * @group      unit
 */
class ContentLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filesystem = $this->getMockFilesystem();
        $this->fmParserFactory = $this->getMockFmParserFactory();

        $this->loader = new ContentLoader(
            $this->filesystem,
            '',
            $this->fmParserFactory
        );
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::load()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getPathname()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getOptions()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getSource()
     */
    public function loadShoulLoadContentWithDefaultFrontMatterParser()
    {
        $this->filesystem->shouldReceive('has')->with('/file1.txt')->once()->andReturn(true);
        $this->filesystem
            ->shouldReceive('read')
            ->with('/file1.txt')
            ->once()
            ->andReturn("---\nkey1: foo\nkey2: bar\n---\nfoobar");

        $parser = $this->getMockFmParser();
        $parser
            ->shouldReceive('parse')
            ->with("key1: foo\nkey2: bar\n")
            ->once()
            ->andReturn(['key1' => 'foo', 'key2' => 'bar']);

        $this->fmParserFactory->shouldReceive('has')->with('yaml')->once()->andReturn(true);
        $this->fmParserFactory->shouldReceive('get')->with('yaml')->once()->andReturn($parser);

        $content = $this->loader->load('file1.txt');

        $this->assertInstanceOf('Cocur\Bundle\PageBundle\Content\Content', $content);
        $this->assertEquals("foobar\n", $content->getSource());
        $this->assertEquals(['key1' => 'foo', 'key2' => 'bar'], $content->getOptions());
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::load()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getPathname()
     *
     * @expectedException Cocur\Bundle\PageBundle\Exception\FileNotExistsException
     */
    public function loadShouldThrowExceptionIfFileDoesNotExists()
    {
        $this->filesystem->shouldReceive('has')->with('/file1.txt')->once()->andReturn(false);
        $this->loader->load('file1.txt');
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::load()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getPathname()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getOptions()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getSource()
     */
    public function loadShoulLoadContentWithoutFrontMatter()
    {
        $this->filesystem->shouldReceive('has')->with('/file1.txt')->once()->andReturn(true);
        $this->filesystem
            ->shouldReceive('read')
            ->with('/file1.txt')
            ->once()
            ->andReturn("foobar");

        $content = $this->loader->load('file1.txt');

        $this->assertInstanceOf('Cocur\Bundle\PageBundle\Content\Content', $content);
        $this->assertEquals("foobar\n", $content->getSource());
        $this->assertEquals([], $content->getOptions());
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::load()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getPathname()
     * @covers Cocur\Bundle\PageBundle\Content\ContentLoader::getOptions()
     *
     * @expectedException \RuntimeException
     */
    public function loadShoulThrowExceptionIfNoFrontMatterParser()
    {
        $this->filesystem->shouldReceive('has')->with('/file1.txt')->once()->andReturn(true);
        $this->filesystem
            ->shouldReceive('read')
            ->with('/file1.txt')
            ->once()
            ->andReturn("---\nkey1: foo\nkey2: bar\n---\nfoobar");

        $this->fmParserFactory->shouldReceive('has')->with('yaml')->once()->andReturn(false);

        $this->loader->load('file1.txt');
    }

    /**
     * @return Gaufrette\Filesystem
     */
    protected function getMockFilesystem()
    {
        return m::mock('Gaufrette\Filesystem');
    }

    /**
     * @return Cocur\Bundle\PageBundle\FmParser\FmParserFactory
     */
    protected function getMockFmParserFactory()
    {
        return m::mock('Cocur\Bundle\PageBundle\FmParser\FmParserFactory');
    }

    /**
     * @return Cocur\Bundle\PageBundle\FmParser\FmParserInterface
     */
    protected function getMockFmParser()
    {
        return m::mock('Cocur\Bundle\PageBundle\FmParser\FmParserInterface');
    }
}
