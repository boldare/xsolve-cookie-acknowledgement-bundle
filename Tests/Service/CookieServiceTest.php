<?php

namespace Xsolve\CoookieBundle\Tests\Service;

use Xsolve\CoookieBundle\Service\CookieService;

class CookieServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $cookieService;
    protected $rflCookieService;

    public function setUp()
    {
        $twig = $this->container->get('templating');
        $this->cookieService = new CookieService($twig);
        $this->rflCookieService = new \ReflectionClass($this->cookieService);
    }

    public function testDefaultTemplate()
    {

        $parameter = $this->container->getParameter('xsolve.cookie_bar.template');
        $this->assertEquals($parameter, $this->rflCookieService->getProperty('template')->getValue());
    }

    public function testCustomTemplate()
    {
        $template = 'Testing::base.html.twig';
        $this->cookieService->setTemplate($template);
        $this->assertEquals($template, $this->rflCookieService->getProperty('template')->getValue());
    }
}
