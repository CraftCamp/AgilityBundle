<?php

namespace Developtech\AgilityBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class FeedbackModel
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $slug;
    /** @var string */
    protected $description;
    /** @var int */
    protected $status;
    /** @var \DateTime*/
    protected $createdAt;
    /** @var \DateTime */
    protected $updatedAt;
    /** @var ProjectModel */
    protected $project;
    /** @var UserInterface */
    protected $author;
    /** @var UserInterface */
    protected $developer;

    const STATUS_OPEN = 0;
    const STATUS_TO_DO = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_TO_VALIDATE = 3;
    const STATUS_DONE = 4;
    const STATUS_CLOSED = 5;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return FeedbackModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return FeedbackModel
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return FeedbackModel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set project
     *
     * @param ProjectModel $project
     *
     * @return FeedbackModel
     */
    public function setProject(ProjectModel $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return ProjectModel
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set author
     *
     * @param UserInterface $author
     *
     * @return FeedbackModel
     */
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return UserInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return FeedbackModel
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set developer
     *
     * @param UserInterface $developer
     *
     * @return FeedbackModel
     */
    public function setDeveloper(UserInterface $developer)
    {
        $this->developer = $developer;

        return $this;
    }

    /**
     * Get developer
     *
     * @return UserInterface
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return FeedbackModel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return FeedbackModel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
