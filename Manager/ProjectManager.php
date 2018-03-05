<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Event\ProjectEvent;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Developtech\AgilityBundle\Utils\Slugger;

class ProjectManager {
    /** @var EntityManager **/
    protected $em;
	/** @var RepositoryManager **/
	protected $repositoryManager;
	/** @var EventDispatcherInterface **/
	protected $eventDispatcher;
    /** @var Slugger **/
    protected $slugger;

    /**
     * @param EntityManager $em
	 * @param RepositoryManager $repositoryManager
	 * @param EventDispatcherInterface $eventDispatcher
     * @param Slugger $slugger
     */
    public function __construct(EntityManager $em, RepositoryManager $repositoryManager, EventDispatcherInterface $eventDispatcher, Slugger $slugger)
    {
        $this->em = $em;
		$this->repositoryManager = $repositoryManager;
		$this->eventDispatcher = $eventDispatcher;
        $this->slugger = $slugger;
    }

    /**
     * @return array
     */
    public function getProjects()
    {
        return $this->em->getRepository(ProjectModel::class)->findAll();
    }

    /**
     * @param string $slug
     * @throws NotFoundHttpException
     * @return ProjectModel
     */
    public function getProject($slug)
    {
        $project = $this->em->getRepository(ProjectModel::class)->findOneBySlug($slug);
        if ($project === null) {
            throw new NotFoundHttpException('Project not found');
        }
        return $project;
    }

    /**
     * @param ProjectModel $project
	 * @param array $repositories
     */
    public function createProject(ProjectModel $project, $repositories = [])
    {
        $project->setSlug($this->slugger->slugify($project->getName()));
		
        $this->em->persist($project);
        $this->em->flush($project);
		
		$this->repositoryManager->createRepositories($project, $repositories);
		
		$this->eventDispatcher->dispatch(ProjectEvent::NAME, new ProjectEvent(ProjectEvent::TYPE_CREATION, $project));
    }

    /**
     * @param ProjectModel $project
     */
    public function editProject(ProjectModel $project)
    {
        $this->em->flush($project);
		
		$this->eventDispatcher->dispatch(ProjectEvent::NAME, new ProjectEvent(ProjectEvent::TYPE_UPDATE, $project));
    }
}
