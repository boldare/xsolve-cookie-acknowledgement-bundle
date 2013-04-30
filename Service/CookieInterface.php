<?php

namespace Xsolve\CookieBundle\Service;


interface CookieInterface
{
    /**
     * 
     * @param \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine $templating - templating service
     * @param string
     */
    public function __construct($templating, $template);
    
    public function render(array $data = array());
}