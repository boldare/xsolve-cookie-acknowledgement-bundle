<?php

namespace Xsolve\CookieAcknowledgementBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your
 * app/config files
 *
 * To learn more see
 * {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#
 *  cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xsolve_cookie_acknowledgement');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->scalarNode('response_injection')
                ->defaultValue(true)
                ->end()

                ->scalarNode('cookie_expiry_time')
                ->defaultValue(365 * 10)
                ->end()

                ->scalarNode('template')
                ->defaultValue('XsolveCookieAcknowledgementBundle::cookie_acknowledgement_bar.html.twig')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
