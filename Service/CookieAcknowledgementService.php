<?php

namespace Xsolve\CookieAcknowledgementBundle\Service;

use Xsolve\CookieAcknowledgementBundle\Service\CookieAcknowledgementInterface;

class CookieAcknowledgementService implements CookieAcknowledgementInterface
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
