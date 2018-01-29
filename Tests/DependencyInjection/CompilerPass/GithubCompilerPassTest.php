<?php

namespace Developtech\AgilityBundle\Tests\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Developtech\AgilityBundle\DependencyInjection\CompilerPass\GithubCompilerPass;

class GithubCompilerPassTest extends \PHPUnit_Framework_TestCase {
    public function testProcess() {
        $container = new ContainerBuilder();
        $container->setParameter('developtech_agility.api', [
            'github' => [
                'client_id' => '12345',
                'client_secret' => '678910',
                'api_url' => 'https://api.github.com/v3'
            ]
        ]);

        $compilerPass = new GithubCompilerPass();
        $compilerPass->process($container);

        $this->assertTrue($container->has('developtech_agility.github_gateway'));
    }

    public function testProcessWithoutParameters() {
        $container = new ContainerBuilder();
        $container->setParameter('developtech_agility.api', []);

        $compilerPass = new GithubCompilerPass();
        $compilerPass->process($container);

        $this->assertFalse($container->has('developtech_agility.github_gateway'));
    }
}
