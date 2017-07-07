<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Entity\Project;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\Security\Core\User\UserInterface;

use Developtech\AgilityBundle\Utils\Slugger;

class ProjectManager {
    /** @var Doctrine\ORM\EntityManager **/
    protected $em;
    /** @var Developtech\AgilityBundle\Utils\Slugger **/
    protected $slugger;

    /**
     * @param Doctrine\ORM\EntityManager $em
     * @param Slugger $slugger
     */
    public function __construct(EntityManager $em, Slugger $slugger) {
        $this->em = $em;
        $this->slugger = $slugger;
    }

    /**
     * @return array
     */
    public function getProjects() {
        return $this->em->getRepository(Project::class)->findAll();
    }

    /**
     * @param string $slug
     * @throws NotFoundHttpException
     * @return ProjectModel
     */
    public function getProject($slug) {
        $project = $this->em->getRepository(Project::class)->findOneBySlug($slug);
        if($project === null) {
            throw new NotFoundHttpException('Project not found');
        }
        return $project;
    }

    /**
     * @param string $name
	 * @param string $description
     * @param UserInterface $productOwner
     * @return \DevelopTech\AgilityBundle\ProjectModel
     */
    public function createProject($name, $description, UserInterface $productOwner) {
        $project =
            (new Project())
            ->setName($name)
            ->setSlug($this->slugger->slugify($name))
			->setDescription($description)
            ->setProductOwner($productOwner)
        ;
		
        $this->em->persist($project);
        $this->em->flush($project);
		
        return $project;
    }

    /**
     * @param integer $id
     * @param string $name
	 * @param string $description
     * @param UserInterface $productOwner
     * @throws NotFoundHttpException
     * @return ProjectModel
     */
    public function editProject($id, $name, $description, UserInterface $productOwner = null) {
        if (($project = $this->em->getRepository(Project::class)->find($id)) === null) {
            throw new NotFoundHttpException('Project not found');
        }
        $project
            ->setName($name)
            ->setSlug($this->slugger->slugify($name))
			->setDescription($description)
        ;
        if($productOwner !== null) {
            $project->setProductOwner($productOwner);
        }
		
        $this->em->flush($project);
		
        return $project;
    }
}
