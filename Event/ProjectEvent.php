<?php

namespace Developtech\AgilityBundle\Event;

use Developtech\AgilityBundle\Model\ProjectModel;

class ProjectEvent {
    /** @var string **/
    protected $type;
    /** @var ProjectModel **/
    protected $project;

    const NAME = 'developtech_agility.event.project';

    const TYPE_CREATION = 'creation';
    const TYPE_UPDATE = 'update';
    const TYPE_REMOVAL = 'removal';

    /**
     * @param string $type
     * @param ProjectModel $project
     */
    public function __construct($type, ProjectModel $project)
    {
        $this->type = $type;
        $this->project = $project;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return ProjectModel
     */
    public function getProject()
    {
        return $this->project;
    }
}
