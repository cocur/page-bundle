<?php

namespace Cocur\Bundle\PageBundle\Tests\Event;

use \Mockery as m;

use Cocur\Bundle\PageBundle\Event\PreLoadEvent;

/**
 * PreLoadEventTest
 *
 * @group unit
 */
class PreLoadEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var PreLoadEvent */
    private $event;

    public function setUp()
    {
        $this->event = new PreLoadEvent('key');
    }

    /**
     * @test
     *
     * @covers Cocur\Bundle\PageBundle\Event\PreLoadEvent::getKey()
     */
    public function getKeyShouldReturnKey()
    {
        $this->assertEquals('key', $this->event->getKey());
    }
}
