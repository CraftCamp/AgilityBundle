<?php

namespace Developtech\AgilityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;

use Developtech\AgilityBundle\Entity\{
    BetaTest,
    BetaTester,
    Project
};
use Developtech\AgilityBundle\Model\{
    BetaTestModel,
    BetaTesterModel,
    ProjectModel
};

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DeveloptechAgilityExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('developtech_agility.user_class', $config['user_class']);
        $container->setParameter('developtech_agility.available_api', [
            'github'
        ]);
        if (isset($config['api'])) {
            $container->setParameter('developtech_agility.api', $config['api']);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
    
    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $entities = [];
        if (!isset($container->getExtensionConfig('doctrine')[0]['orm']['resolve_target_entities'][BetaTestModel::class])) {
            $entities[BetaTestModel::class] = BetaTest::class;
        }
        if (!isset($container->getExtensionConfig('doctrine')[0]['orm']['resolve_target_entities'][BetaTesterModel::class])) {
            $entities[BetaTesterModel::class] = BetaTester::class;
        }
        if (!isset($container->getExtensionConfig('doctrine')[0]['orm']['resolve_target_entities'][ProjectModel::class])) {
            $entities[ProjectModel::class] = Project::class;
        }
        $container->prependExtensionConfig('doctrine', [ 'orm' => [ 'resolve_target_entities' => $entities ]]);
    }
}
