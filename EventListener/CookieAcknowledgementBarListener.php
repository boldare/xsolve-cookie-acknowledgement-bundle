<?php

namespace Xsolve\CookieAcknowledgementBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

use Xsolve\CookieAcknowledgementBundle\Service\CookieAcknowledgementService;

class CookieAcknowledgementBarListener implements EventSubscriberInterface
{
    protected $cookieService;
    protected $cookieExpiryTime = 10;

    protected static $listenerKernelPriority = -128;

    public function __construct(CookieAcknowledgementService $cookieService, $cookieExpiryTime)
    {
        $this->cookieService = $cookieService;
        $this->cookieExpiryTime = $cookieExpiryTime;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $response = $event->getResponse();
        $request = $event->getRequest();

        if (!$request->cookies->has('cookie_law_accepted')) {
            $this->injectCookieBar($response);
        }
    }

    protected function injectCookieBar(Response $response)
    {
        $content = $response->getContent();
        $pos = mb_strripos($content, '</body>');

        if (false !== $pos) {
            $toolbar = sprintf("\n%s\n", $this->cookieService->render(array('cookieExpiryTime' => $this->cookieExpiryTime)));
            $content = mb_substr($content, 0, $pos) . $toolbar . mb_substr($content, $pos);
            $response->setContent($content);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::RESPONSE => array('onKernelResponse', self::listenerKernelPriority),
        );
    }
}
