<?php

namespace Cocur\Bundle\PageBundle\Tests\Event;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Event\PreCompileEvent;

/**
 * PreCompileEventTest
 *
 * @group unit
 */
class PreCompileEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var PreCompileEvent */
    private $event;

    /** @var Cocur\Bundle\PageBundle\Content\Content */
    private $content;

    public function setUp()
    {
        $this->content = m::mock('Cocur\Bundle\PageBundle\Content\Content');
        $this->event = new PreCompileEvent($this->content);
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Event\PreCompileEvent::getContent()
     */
    public function getContentShouldReturnContent()
    {
        $this->assertEquals($this->content, $this->event->getContent());
    }
}
