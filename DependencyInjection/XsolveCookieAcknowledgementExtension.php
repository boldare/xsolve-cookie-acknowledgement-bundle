<?php

namespace Xsolve\CookieAcknowledgementBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XsolveCookieAcknowledgementExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($config['response_injection'] && $config['cookie_expiry_time']) {
            $this->registerResponseListener($container, $config['cookie_expiry_time']);
        }
        $container->setParameter('xsolve.cookie_acknowledgement_bar.template', $config['template']);
    }

    protected function registerResponseListener(ContainerBuilder $container, $cookieExpiryTime)
    {
        $definition = new Definition();
        $definition->setClass($container->getParameter('xsolve.cookie_acknowledgement_bar.event_listener.class'));
        $definition->addArgument(new Reference('xsolve.cookie_acknowledgement_bar.service'));
        $definition->addArgument($cookieExpiryTime);

        $definition->addTag('kernel.event_listener', array(
            'event' => 'kernel.response',
            'method' => 'onKernelResponse'
        ));

        $container->setDefinition('xsolve.cookie_acknowledgement_bar.event_listener', $definition);
    }
}
