<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Entity\Project;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;

class ProjectManager {
    /** @var Doctrine\ORM\EntityManager **/
    protected $em;
    /** @var string **/
    protected $projectClass;

    /**
     * @param Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em, $projectClass) {
        $this->em = $em;
        $this->projectClass = $projectClass;
    }

    /**
     * @return array
     */
    public function getProjects() {
        return $this->em->getRepository($this->projectClass)->findAll();
    }

    /**
     * @param string $slug
     * @return ProjectModel
     */
    public function getProject($slug) {
        $project = $this->em->getRepository($this->projectClass)->findOneBySlug($slug);
        if($project === null) {
            throw new HttpNotFoundException('Project not found');
        }
        return $project;
    }
}
