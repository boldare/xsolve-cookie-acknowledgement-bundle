<?php

namespace Xsolve\CookieAcknowledgementBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Exception;

class XsolveCookieAcknowledgementBundle extends Bundle
{
    public function __construct()
    {
        if (!function_exists('mb_stripos')) {
            throw new Exception('function mb_stripos is required to proper bundle initialization');
        }
    }
}
