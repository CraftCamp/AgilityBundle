<?php

namespace Developtech\AgilityBundle\Entity\Repository;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="developtech_agility__repositories__github")
 */
class GithubRepository extends Repository
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
	 * @ORM\Column(type="string", length=15)
	 */
	protected $ownerType;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(type="string", length=255)
	 */
	protected $name;
	
	const OWNER_USER = 'user';
	const OWNER_ORGANIZATION = 'organization';
	
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
	 * @param string $ownerType
	 * @return GithubRepository
	 */
	public function setOwnerType($ownerType)
	{
		$this->ownerType = $ownerType;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getOwnerType()
	{
		return $this->ownerType;
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