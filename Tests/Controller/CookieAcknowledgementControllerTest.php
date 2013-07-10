<?php

namespace Xsolve\CookieAcknowledgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

class CookieAcknowledgementControllerTest extends WebTestCase
{
    public function testIfCookieAcknowledgementAppearAndClose()
    {
        $client = static::createClient();

        //clear cookies
        $client->getCookieJar()->expire('cookie.message');
        $client->getCookieJar()->expire('cookie.message.accept');

        //check if cleared cookies not exist
        $this->assertTrue($client->getCookieJar()->get('cookie.message.accept') == null);
        $this->assertTrue($client->getCookieJar()->get('cookie.message') == null);

        //check if cookie bar appear
        $crawler = $client->request('GET', '/');
        $this->assertTrue($crawler->filter('#cookie-law-info-bar')->count() > 0);

        //set cookies in cookiejar
        $client->getCookieJar()->set(new Cookie('cookie.message.accept', 'fr', time() + 3600 * 24 * 7, '/', null, false, false));
        $client->getCookieJar()->set(new Cookie('cookie.message', 'fr', time() + 3600 * 24 * 7, '/', null, false, false));
        $client->getCookieJar()->set(new Cookie('cookie_law_accepted', '1', time() + 3600 * 24 * 7, '/', null, false, false));

        //click to hide cookie box
        $link = $crawler->filter('#cookie-law-close-button')->link();
        $crawler = $client->click($link);

        //check if cleared cookies not exist
        $this->assertTrue($client->getCookieJar()->get('cookie.message.accept') != null);
        $this->assertTrue($client->getCookieJar()->get('cookie.message') != null);

        //check if cookie box is hidden
        $crawler = $client->request('GET', '/');
        $this->assertTrue($crawler->filter('#cookie-law-info-bar')->count() == 0);
    }
}
