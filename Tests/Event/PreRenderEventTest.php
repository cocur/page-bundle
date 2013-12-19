<?php

namespace Cocur\Bundle\PageBundle\Tests\Event;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Event\PreRenderEvent;

/**
 * PreRenderEventTest
 *
 * @group unit
 */
class PreRenderEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var PreRenderEvent */
    private $event;

    public function setUp()
    {
        $this->event = new PreRenderEvent([ 'title' => 'foo', 'content' => 'foobar' ]);
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Event\PreRenderEvent::getVars()
     */
    public function getVarsShouldReturnVars()
    {
        $this->assertEquals([ 'title' => 'foo', 'content' => 'foobar' ], $this->event->getVars());
    }
}
