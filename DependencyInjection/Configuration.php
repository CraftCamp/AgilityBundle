<?php

namespace Developtech\AgilityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('developtech_agility');
        $rootNode
            ->children()
                ->scalarNode('user_class')->isRequired()->end()
                ->arrayNode('api')
                    ->children()
                        ->arrayNode('github')
                            ->children()
                                ->scalarNode('api_url')->end()
                                ->scalarNode('client_id')->end()
                                ->scalarNode('client_secret')->end()
                                ->scalarNode('redirect_uri')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
