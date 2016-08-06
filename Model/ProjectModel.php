<?php

namespace Developtech\AgilityBundle\Model;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Project
 */
abstract class ProjectModel
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $slug;
    /** @var string **/
    protected $description;
    /** @var \DateTime */
    protected $createdAt;
    /** @var int */
    protected $nbBetaTesters;
    /** @var string */
    protected $betaTestStatus;
    /** @var UserInterface */
    protected $productOwner;
    /** @var ArrayCollection */
    protected $features;
    /** @var ArrayCollection */
    protected $feedbacks;

    public function __construct() {
        $this->features = new ArrayCollection();
        $this->feedbacks = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProjectModel
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
     * @return ProjectModel
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
     * @param string $description
     * @return ProjectModel
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

    /**
     * Set nbBetaTesters
     *
     * @param integer $nbBetaTesters
     *
     * @return ProjectModel
     */
    public function setNbBetaTesters($nbBetaTesters)
    {
        $this->nbBetaTesters = $nbBetaTesters;

        return $this;
    }

    /**
     * Get nbBetaTesters
     *
     * @return int
     */
    public function getNbBetaTesters()
    {
        return $this->nbBetaTesters;
    }

    /**
     * Set betaTestStatus
     *
     * @param string $betaTestStatus
     *
     * @return ProjectModel
     */
    public function setBetaTestStatus($betaTestStatus)
    {
        $this->betaTestStatus = $betaTestStatus;

        return $this;
    }

    /**
     * Get betaTestStatus
     *
     * @return string
     */
    public function getBetaTestStatus()
    {
        return $this->betaTestStatus;
    }

    /**
     * Set productOwner
     *
     * @param UserInterface $productOwner
     *
     * @return ProjectModel
     */
    public function setProductOwner(UserInterface $productOwner)
    {
        $this->productOwner = $productOwner;

        return $this;
    }

    /**
     * Get productOwner
     *
     * @return UserInterface
     */
    public function getProductOwner()
    {
        return $this->productOwner;
    }

    /**
     * @param JobModel $feature
     * @return ProjectModel
     */
    public function addFeature(JobModel $feature) {
        $this->features->add($feature);

        return $this;
    }

    /**
     * @param JobModel $feature
     * @return ProjectModel
     */
    public function removeFeature(JobModel $feature) {
        $this->features->removeElement($feature);

        return $this;
    }

    /**
     * @param JobModel $feature
     * @return boolean
     */
    public function hasFeature(JobModel $feature) {
        return $this->features->contains($feature);
    }

    /**
     * @return ArrayCollection
     */
    public function getFeatures() {
        return $this->features;
    }

    /**
     * @param JobModel $feedback
     * @return ProjectModel
     */
    public function addFeedback(JobModel $feedback) {
        $this->feedbacks->add($feedback);

        return $this;
    }

    /**
     * @param JobModel $feedback
     * @return ProjectModel
     */
    public function removeFeedback(JobModel $feedback) {
        $this->feedbacks->removeElement($feedback);

        return $this;
    }

    /**
     * @param JobModel $feedback
     * @return boolean
     */
    public function hasFeedback(JobModel $feedback) {
        return $this->feedbacks->contains($feedback);
    }

    /**
     * @return ArrayCollection
     */
    public function getFeedbacks() {
        return $this->feedbacks;
    }
}
