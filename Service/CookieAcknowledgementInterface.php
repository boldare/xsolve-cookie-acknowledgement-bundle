<?php

namespace Xsolve\CookieAcknowledgementBundle\Service;

interface CookieAcknowledgementInterface
{
    /**
     *
     * @param \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine $templating - templating service
     * @param string
     */
    public function __construct($templating, $template);

    public function render(array $data = array());
}
