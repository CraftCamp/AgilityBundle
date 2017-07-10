<?php

namespace Developtech\AgilityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Developtech\AgilityBundle\DependencyInjection\CompilerPass\GithubCompilerPass;

class DeveloptechAgilityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new GithubCompilerPass());
    }
}
