<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Entity\Project;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;

use Symfony\Component\Security\Core\User\UserInterface;

use Developtech\AgilityBundle\Utils\Slugger;

class ProjectManager {
    /** @var Doctrine\ORM\EntityManager **/
    protected $em;
    /** @var Developtech\AgilityBundle\Utils\Slugger **/
    protected $slugger;
    /** @var string **/
    protected $projectClass;

    /**
     * @param Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em, Slugger $slugger, $projectClass) {
        $this->em = $em;
        $this->slugger = $slugger;
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

    /**
     * @param string $name
     * @param UserInterface $productOwner
     * @return \DevelopTech\AgilityBundle\ProjectModel
     */
    public function createProject($name, UserInterface $productOwner) {
        $project =
            (new $this->projectClass())
            ->setName($name)
            ->setSlug($this->slugger->slugify($name))
            ->setProductOwner($productOwner)
            ->setBetaTestStatus('closed')
            ->setNbBetaTesters(0)
        ;
        $this->em->persist($project);
        $this->em->flush();
        return $project;
    }
}
