<?php

namespace Developtech\AgilityBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

use Developtech\AgilityBundle\Api\Gateway\GithubGateway;


class GithubCompilerPass implements CompilerPassInterface {
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container) {
        if (!$container->hasParameter('developtech_agility.api')) {
            return false;
        }
        $api = $container->getParameter('developtech_agility.api');

        if (!isset($api['github'])) {
            return false;
        }
        $container->setDefinition('developtech_agility.github_gateway',
            (new Definition())
            ->setClass(GithubGateway::class)
            ->addArgument($api['github']['api_url'])
            ->addArgument($api['github']['client_id'])
            ->addArgument($api['github']['client_secret'])
            ->addArgument($api['github']['redirect_uri'])
            ->addArgument(new Reference('session'))
        );
    }
}
