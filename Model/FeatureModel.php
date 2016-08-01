<?php

namespace Developtech\AgilityBundle\Model;

abstract class FeatureModel {
    /** @var string */
    protected $type;
    /** @var string */
    protected $name;
    /** @var string */
    protected $slug;
    /** @var string*/
    protected $description;
    /** @var integer */
    protected $productOwnerValue;
    /** @var integer*/
    protected $userValue;
    /** @var \DateTime*/
    protected $createdAt;
    /** @var \DateTime */
    protected $updatedAt;
    /** @var integer */
    protected $status;

    /**
     * @var ProjectModel
     *
     * This field must be mapped by the end-user
     */
    protected $project;

    /**
     * @var object
     *
     * This field must be mapped by the end-user
     */
    protected $developer;

    const STATUS_TO_SPECIFY = 0;
    const STATUS_TO_VALORIZE = 1;
    const STATUS_READY = 2;
    const STATUS_TO_DO = 3;
    const STATUS_IN_PROGRESS = 4;
    const STATUS_TO_VALIDATE = 5;
    const STATUS_TO_DEPLOY = 6;

    /**
     * @param string $type
     * @return FeatureModel
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $name
     * @return FeatureModel
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $slug
     * @return FeatureModel
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $description
     * @return FeatureModel
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param ProjectModel $project
     * @return FeatureModel
     */
    public function setProject(ProjectModel $project) {
        $this->project = $project;

        return $this;
    }

    /**
     * @return FeatureModel
     */
    public function getProject() {
        return $this->project;
    }

    /**
     * @param integer $productOwnerValue
     * @return FeatureModel
     */
    public function setProductOwnerValue($productOwnerValue) {
        $this->productOwnerValue = $productOwnerValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductOwnerValue() {
        return $this->productOwnerValue;
    }

    /**
     * @var integer $userValue
     * @return FeatureModel
     */
    public function setUserValue($userValue) {
        $this->userValue = $userValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserValue() {
        return $this->userValue;
    }

    /**
     * @param integer $status
     * @return FeatureModel
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param object $developer
     * @return FeatureModel
     */
    public function setDeveloper($developer) {
        $this->developer = $developer;

        return $this;
    }

    /**
     * @return object
     */
    public function getDeveloper() {
        return $this->developer;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ProjectModel
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
     * @return ProjectModel
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
