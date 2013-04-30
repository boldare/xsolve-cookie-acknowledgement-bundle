<?php

namespace Xsolve\CookieBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Xsolve\CookieBundle\Service\CookieInterface;

class CookieService implements CookieInterface
{
    protected $template;
    
    /**
     *
     * @var \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine
     */
    protected $templating;
    
    public function __construct($templating, $template)
    {
        $this->templating = $templating;
        $this->template   = $template;
    }

    public function render(array $data = array())
    {
        return $this->templating->render($this->template, $data);
    }

}
