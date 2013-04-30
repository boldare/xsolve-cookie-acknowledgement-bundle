<?php

namespace Xsolve\CookieBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerAware;


class CookieService extends ContainerAware
{
    protected $template;

    public function render(array $data = array())
    {
        $templating = $this->container->get('templating');
        return $templating->render($this->template, $data);
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
