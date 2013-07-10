<?php

namespace Xsolve\CookieAcknowledgementBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

use Xsolve\CookieBundle\Service\CookieService;

class CookieBarListener implements EventSubscriberInterface
{
    protected $cookieService;

    protected static $listenerKernelPriority = -128;

    public function __construct(CookieService $cookieService)
    {
        $this->cookieService = $cookieService;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $response = $event->getResponse();
        $request = $event->getRequest();

        if (!$request->cookies->has('cookie_law_accepted')) {
            $this->injectCookieBarWithCssClass($response);
        }
    }

    public function injectCookieBarWithCssClass(Response $response, $cssClass)
    {
        if (function_exists('mb_stripos')) {
            $posrFunction   = 'mb_strripos';
            $substrFunction = 'mb_substr';
        } else {
            $posrFunction   = 'strripos';
            $substrFunction = 'substr';
        }

        $content = $response->getContent();
        $pos = $posrFunction($content, '</body>');

        if (false !== $pos) {
            $toolbar = "\n".$this->cookieService->render()."\n";
            $content = $substrFunction($content, 0, $pos).$toolbar.$substrFunction($content, $pos);
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
