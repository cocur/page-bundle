<?php

namespace Cocur\Bundle\PageBundle\Tests\Event;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Event\PostRenderEvent;

/**
 * PostRenderEventTest
 *
 * @group unit
 */
class PostRenderEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var PostRenderEvent */
    private $event;

    /** @var Symfony\Component\HttpFoundation\Response */
    private $response;

    public function setUp()
    {
        $this->response = m::mock('Symfony\Component\HttpFoundation\Response');
        $this->event = new PostRenderEvent($this->response);
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Event\PostRenderEvent::getResponse()
     */
    public function getResponseShouldReturnResponse()
    {
        $this->assertEquals($this->response, $this->event->getResponse());
    }
}
