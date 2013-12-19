<?php

namespace Cocur\Bundle\PageBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * PostCompileEvent
 */
class PostCompileEvent extends Event
{
    /** @var array */
    private $vars;

    /**
     * Constructor.
     *
     * @param array $vars Compiled variables.
     *
     * @codeCoverageIgnore
     */
    public function __construct(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * Returns the compiled variables.
     *
     * @return array Compiled variables.
     */
    public function getVars()
    {
        return $this->vars;
    }
}
