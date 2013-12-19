<?php

namespace Cocur\Bundle\PageBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * PreRenderEvent
 */
class PreRenderEvent extends Event
{
    /** @var array */
    private $vars;

    /**
     * Constructor.
     *
     * @param array $vars Variables
     *
     * @codeCoverageIgnore
     */
    public function __construct(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * Returns the variables.
     *
     * @return array Variables
     */
    public function getVars()
    {
        return $this->vars;
    }
}
