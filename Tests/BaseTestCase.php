<?php

namespace Xsolve\CookieAcknowledgementBundle\Tests;

require_once(__DIR__ . "/../../../../app/AppKernel.php");

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
  protected $container;

  public function __construct()
  {
    $kernel = new \AppKernel("test", true);
    $kernel->boot();
    $this->_container = $kernel->getContainer();
    parent::__construct();
  }

  protected function get($service)
  {
    return $this->container->get($service);
  }
}
