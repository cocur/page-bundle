<?php

namespace Cocur\Bundle\PageBundle\Tests\Event;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Event\PostCompileEvent;

/**
 * PostCompileEventTest
 *
 * @group unit
 */
class PostCompileEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var PostCompileEvent */
    private $event;

    public function setUp()
    {
        $this->event = new PostCompileEvent([ 'title' => 'foo', 'content' => 'foobar' ]);
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Event\PostCompileEvent::getVars()
     */
    public function getVarsShouldReturnVars()
    {
        $this->assertEquals([ 'title' => 'foo', 'content' => 'foobar' ], $this->event->getVars());
    }
}
