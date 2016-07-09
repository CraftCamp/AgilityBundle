<?php

namespace DevelopTech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use DevelopTech\AgilityBundle\Entity\Project;

class ProjectManager {
    /** @var Doctrine\ORM\EntityManager **/
    protected $em;

    /**
     * @param Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getProjects() {
        return $this->em->getRepository(Project::class)->findAll();
    }
}
