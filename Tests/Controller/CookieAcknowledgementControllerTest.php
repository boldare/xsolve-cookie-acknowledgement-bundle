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

    public function testIfCookieAcknowledgementBarAppearsIfCookieIsPresent()
    {
        $client = static::createClient();

        //set cookies in cookiejar
        $client->getCookieJar()->set(new Cookie('cookie_law_accepted', '1', time() + 3600 * 24 * 7, '/', null, false, false));

        //check if cookie box is not present
        $crawler = $client->request('GET', '/');
        $this->assertEquals(0, $crawler->filter('#cookie-law-info-bar')->count());
    }
}
