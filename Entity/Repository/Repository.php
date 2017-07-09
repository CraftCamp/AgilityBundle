<?php

namespace Developtech\AgilityBundle\Entity\Repository;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\RepositoryModel;

/**
 * @ORM\Entity()
 * @ORM\Table(name="developtech_agility__repositories__repository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string", length=10)
 * @ORM\DiscriminatorMap({
 *     "github" = "Github"
 * })
 */
abstract class Repository extends RepositoryModel
{
	/**
	 * @var string
	 * 
	 * @ORM\ManyToOne(targetEntity="Developtech\AgilityBundle\Entity\Project", inversedBy="repositories")
	 * @ORM\JoinColumn(nullable=false) 
	 */
	protected $project;
}