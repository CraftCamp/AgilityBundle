<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Entity\Project;
use Developtech\AgilityBundle\Entity\BetaTest;

class BetaTestManager {
    /** @var EntityManager **/
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param Project $project
     * @return array
     */
    public function getByProject(Project $project) {
        return $this->em->getRepository(BetaTest::class)->findByProject($project);
    }
}
