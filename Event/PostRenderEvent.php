<?php

namespace Cocur\Bundle\PageBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;

/**
 * PostRenderEvent
 */
class PostRenderEvent extends Event
{
    /** @var Response */
    private $response;

    /**
     * Constructor.
     *
     * @param Response $response Response
     *
     * @codeCoverageIgnore
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Returns the response.
     *
     * @return Response The response.
     */
    public function getResponse()
    {
        return $this->response;
    }
}
