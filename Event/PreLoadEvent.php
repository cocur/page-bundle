<?php

namespace Cocur\Bundle\PageBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * PreLoadEvent
 */
class PreLoadEvent extends Event
{
    /** @var string */
    private $key;

    /**
     * Constructor.
     *
     * @param string $key Key of the content.
     *
     * @codeCoverageIgnore
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Returns the key of the content.
     *
     * @return string Key of the content.
     */
    public function getKey()
    {
        return $this->key;
    }
}
