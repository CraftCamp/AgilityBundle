<?php

namespace DevelopTech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use DevelopTech\AgilityBundle\Entity\Project;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;

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
        return $this->em->getRepository(ProjectModel::class)->findAll();
    }

    /**
     * @param string $slug
     * @return ProjectModel
     */
    public function getProject($slug) {
        $project = $this->em->getRepository(ProjectModel::class)->findOneBySlug($slug);
        if($project === null) {
            throw new HttpNotFoundException('Project not found');
        }
        return $project;
    }
}
