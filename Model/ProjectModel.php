<?php

namespace Developtech\AgilityBundle\Model;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

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
    /**
     * @var object
     *
     * The mapping to the user class must be done by the end-user
     */
    protected $productOwner;

    /**
     * @var ArrayCollection
     *
     * The mapping to the features can be done by the end-user but is optionnal
     */
    protected $features;

    /**
     * @var ArrayCollection
     *
     * The mapping to the feedbacks can be done by the end-user but is optionnal
     */
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
     * @param object $productOwner
     *
     * @return ProjectModel
     */
    public function setProductOwner($productOwner)
    {
        $this->productOwner = $productOwner;

        return $this;
    }

    /**
     * Get productOwner
     *
     * @return object
     */
    public function getProductOwner()
    {
        return $this->productOwner;
    }

    /**
     * @param FeatureModel $feature
     * @return ProjectModel
     */
    public function addFeature(FeatureModel $feature) {
        $this->features->add($feature);

        return $this;
    }

    /**
     * @param FeatureModel $feature
     * @return ProjectModel
     */
    public function removeFeature(FeatureModel $feature) {
        $this->features->removeElement($feature);

        return $this;
    }

    /**
     * @param FeatureModel $feature
     * @return boolean
     */
    public function hasFeature(FeatureModel $feature) {
        return $this->features->contains($feature);
    }

    /**
     * @return ArrayCollection
     */
    public function getFeatures() {
        return $this->features;
    }

    /**
     * @param FeedbackModel $feedback
     * @return ProjectModel
     */
    public function addFeedback(FeedbackModel $feedback) {
        $this->feedbacks->add($feedback);

        return $this;
    }

    /**
     * @param FeedbackModel $feedback
     * @return ProjectModel
     */
    public function removeFeedback(FeedbackModel $feedback) {
        $this->feedbacks->removeElement($feedback);

        return $this;
    }

    /**
     * @param FeedbackModel $feedback
     * @return boolean
     */
    public function hasFeedback(FeedbackModel $feedback) {
        return $this->feedbacks->contains($feedback);
    }

    /**
     * @return ArrayCollection
     */
    public function getFeedbacks() {
        return $this->feedbacks;
    }
}
