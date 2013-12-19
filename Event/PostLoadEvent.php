<?php

namespace Cocur\Bundle\PageBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use Cocur\Bundle\PageBundle\Content\Content;

/**
 * PostLoadEvent
 */
class PostLoadEvent extends Event
{
    /** @var Content */
    private $content;

    /**
     * Constructor.
     *
     * @param Content $content Content.
     *
     * @codeCoverageIgnore
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Returns the content.
     *
     * @return Content Content.
     */
    public function getContent()
    {
        return $this->content;
    }
}
