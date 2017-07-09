<?php

namespace Developtech\AgilityBundle\Entity\Repository;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\RepositoryModel;

/**
 * @ORM\Entity()
 * @ORM\Table(name="developtech_agility__repositories__github")
 */
class GithubRepository extends RepositoryModel
{
	/**
	 * @var string
	 * 
	 * @ORM\Column(type="string", length=255)
	 */
	protected $owner;
	/**
	 * @var string
	 * 
	 * @ORM\Column(type="string", length=255)
	 */
	protected $name;
	
	/**
	 * @param string $owner
	 * @return GithubRepository
	 */
	public function setOwner($owner)
	{
		$this->owner = $owner;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getOwner()
	{
		return $this->owner;
	}
	
	/**
	 * @param string $name
	 * @return GithubRepository
	 */
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}