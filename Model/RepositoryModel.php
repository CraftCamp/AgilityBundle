<?php

namespace Developtech\AgilityBundle\Model;

abstract class RepositoryModel
{
	/** @var string **/
	protected $type;
	/** @var ProjectModel **/
	protected $project;
	
	const TYPE_GITHUB = 'github';
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @param ProjectModel $project
	 * @return RepositoryModel
	 */
	public function setProject(ProjectModel $project)
	{
		$this->project = $project;
		
		return $this;
	}
	
	/**
	 * @return ProjectModel
	 */
	public function getProject()
	{
		return $this->project;
	}
}