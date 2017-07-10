<?php

namespace Developtech\AgilityBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

use Developtech\AgilityBundle\Api\Gateway\GithubGateway;


class GithubCompilerPass implements CompilerPassInterface {
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container) {
        $api = $container->getParameter('developtech_agility.api');

        if (!isset($api['github'])) {
            return false;
        }
        $container->set('developtech_agility.github_gateway',
            (new Definition())
            ->setClass(GithubGateway::class)
            ->addArgument($api['github']['api_url'])
            ->addArgument($api['github']['client_id'])
            ->addArgument($api['github']['client_secret'])
            ->addArgument('@session')
        );
    }
}
