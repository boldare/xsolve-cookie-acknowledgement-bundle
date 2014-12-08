<?php

namespace Xsolve\CookieAcknowledgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

class CookieAcknowledgementControllerTest extends WebTestCase
{
    public function testIfCookieAcknowledgementBarAppearsIfCookieIsNotSet()
    {
        $client = static::createClient();
        $client->restart();

        //check if cookie bar appear
        $crawler = $client->request('GET', '/');
        $this->assertEquals(1, $crawler->filter('#cookie-law-info-bar')->count());

    }
}
