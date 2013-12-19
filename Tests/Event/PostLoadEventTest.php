<?php

namespace Cocur\Bundle\PageBundle\Tests\Event;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Event\PostLoadEvent;

/**
 * PostLoadEventTest
 *
 * @group unit
 */
class PostLoadEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var PostLoadEvent */
    private $event;

    /** @var Cocur\Bundle\PageBundle\Content\Content */
    private $content;

    public function setUp()
    {
        $this->content = m::mock('Cocur\Bundle\PageBundle\Content\Content');
        $this->event = new PostLoadEvent($this->content);
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Event\PostLoadEvent::getContent()
     */
    public function getContentShouldReturnContent()
    {
        $this->assertEquals($this->content, $this->event->getContent());
    }
}
