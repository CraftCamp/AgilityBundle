<?php

namespace Developtech\AgilityBundle\Tests\Repository;

use Developtech\AgilityBundle\DataFixtures\ORM\LoadProjectData;
use Developtech\AgilityBundle\DataFixtures\ORM\LoadFeedbackData;

use Liip\FunctionalTestBundle\Test\WebTestCase;

use Developtech\AgilityBundle\Entity\Project;
use Developtech\AgilityBundle\Entity\Feedback;

class FeedbackRepositoryTest extends WebTestCase {
    /** @var \AppBundle\Repository\Troop\TroopRepository **/
    protected $repository;

    public function setUp() {
        $this->repository = $this->getContainer()->get('doctrine')->getRepository(Feedback::class);

        $this->loadFixtures([
            LoadProjectData::class,
            LoadFeedbackData::class
        ]);
    }

    public function testCountPerStatus() {
        $this->assertEquals(2, $this->repository->countPerStatus((new Project())->setId(1), Feedback::STATUS_OPEN));
    }
}
