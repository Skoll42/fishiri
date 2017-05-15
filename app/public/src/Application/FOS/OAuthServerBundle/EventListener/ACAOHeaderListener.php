<?php

namespace Application\FOS\OAuthServerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Class ACAOHeaderListener
 * @package Application\FOS\OAuthServerBundle\EventListener
 */
class ACAOHeaderListener
{
    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
    }
}
