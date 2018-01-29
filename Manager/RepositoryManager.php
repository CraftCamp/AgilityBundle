<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Api\Gateway\GithubGateway;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Model\RepositoryModel;
use Developtech\AgilityBundle\Entity\Repository\GithubRepository;

class RepositoryManager
{
	/** @var EntityManager **/
	protected $entityManager;
	/** @var GithubGateway **/
	protected $githubGateway;
	
	/**
	 * @param EntityManager $entityManager
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}
	
	/**
	 * @param GithubGateway $githubGateway
	 */
	public function setGithubGateway(GithubGateway $githubGateway)
	{
		$this->githubGateway = $githubGateway;
	}
	
	/**
	 * @param ProjectModel $project
	 * @param array $repositories
	 * @throws \InvalidArgumentException
	 */
	public function createRepositories(ProjectModel $project, $repositories = [])
	{
		foreach ($repositories as $data) {
			if (empty($data['type'])) {
				throw new \InvalidArgumentException('developtech_agility.repositories.invalid_type');
			}
			switch ($data['type']) {
				case RepositoryModel::TYPE_GITHUB:
					$this->createGithubRepository($data['owner'], $data['name'], $data['owner_type'], $project);
				default:
					throw new \InvalidArgumentException('developtech_agility.repositories.invalid_type');
			}
		}
	}
	
	/**
	 * @param string $owner
	 * @param string $name
	 * @param string $ownerType
	 * @param ProjectModel $project
	 * @return GithubRepository
	 */
	public function createGithubRepository($owner, $name, $ownerType, ProjectModel $project)
	{
		if (!$this->githubGateway instanceof GithubGateway) {
			throw new \InvalidArgumentException('developtech_agility.repositories.missing_github_configuration');
		}
		$repository =
			(new GithubRepository())
			->setName($name)
			->setOwner($owner)
			->setOwnerType($ownerType)
			->setProject($project)
		;
		$this->entityManager->persist($repository);
		$this->entityManager->flush($repository);
		
		$this->githubGateway->createRepository($repository);
		
		$project->addRepository($repository);
		
		return $repository;
	}
}