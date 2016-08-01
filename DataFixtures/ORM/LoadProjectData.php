<?php
namespace Developtech\AgilityBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\{
    AbstractFixture,
    OrderedFixtureInterface
};
use Symfony\Component\DependencyInjection\{
    ContainerInterface,
    ContainerAwareInterface
};

use Developtech\AgilityBundle\Entity\Project;

class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    /** @var ContainerInterface */
    private $container;
    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $data = include('fixtures/projects.php');
        foreach ($data as $projectData)
        {
            $project =
                (new Project())
                ->setId($projectData['id'])
                ->setName($projectData['name'])
                ->setSlug($projectData['slug'])
                ->setDescription($projectData['description'])
                ->setBetaTestStatus($projectData['beta_test_status'])
                ->setNbBetaTesters($projectData['nb_beta_testers'])
                ->setCreatedAt(new \DateTime($projectData['created_at']))
            ;
            $manager->persist($project);
            $this->addReference("project-{$project->getId()}", $project);
        }
        $manager->flush();
        $manager->clear(Project::class);
    }
    /**
     * @return int
     */
    public function getOrder() {
        return 1;
    }
}
