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
use Developtech\AgilityBundle\Entity\Feedback;

class LoadFeedbackData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
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
        $data = include('fixtures/feedbacks.php');
        foreach ($data as $feedbackData)
        {
            $feedback =
                (new Feedback())
                ->setId($feedbackData['id'])
                ->setProject($this->getReference("project-{$feedbackData['project_id']}"))
                ->setName($feedbackData['name'])
                ->setSlug($feedbackData['slug'])
                ->setDescription($feedbackData['description'])
                ->setStatus($feedbackData['status'])
                ->setCreatedAt(new \DateTime($feedbackData['created_at']))
                ->setUpdatedAt(new \DateTime($feedbackData['updated_at']))
            ;
            $manager->persist($feedback);
        }
        $manager->flush();
        $manager->clear(Feedback::class);
    }
    /**
     * @return int
     */
    public function getOrder() {
        return 2;
    }
}
