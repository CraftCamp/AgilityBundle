<?php

namespace Developtech\AgilityBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Project
 */
abstract class ProjectModel
{
    /** @var string **/
    protected $name;
    /** @var string **/
    protected $slug;
    /** @var string **/
    protected $description;
    /** @var \DateTime **/
    protected $createdAt;
    /** @var \DateTime **/
    protected $updatedAt;
    /** @var ArrayCollection **/
    protected $betaTests;
    /** @var UserInterface **/
    protected $productOwner;
    /** @var ArrayCollection **/
    protected $features;
    /** @var ArrayCollection **/
    protected $feedbacks;
	/** @var ArrayCollection **/
	protected $repositories;

    public function __construct() {
        $this->betaTests = new ArrayCollection();
        $this->features = new ArrayCollection();
        $this->feedbacks = new ArrayCollection();
        $this->repositories = new ArrayCollection();
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
     * @param BetaTestModel $betaTest
     * @return ProjectModel
     */
    public function addBetaTest(BetaTestModel $betaTest) {
        $this->betaTests->add($betaTest);

        return $this;
    }

    /**
     * @param BetaTestModel $betaTest
     * @return ProjectModel
     */
    public function removeBetaTest(BetaTestModel $betaTest) {
        $this->betaTests->removeElement($betaTest);

        return $this;
    }

    /**
     * @param BetaTestModel $betaTest
     * @return boolean
     */
    public function hasBetaTest(BetaTestModel $betaTest) {
        return $this->betaTests->contains($betaTest);
    }

    /**
     * @return ArrayCollection
     */
    public function getBetaTests() {
        return $this->betaTests;
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

    /**
     * @param RepositoryModel $repository
     * @return ProjectModel
     */
    public function addRepository(RepositoryModel $repository) {
        $this->repositories->add($repository);

        return $this;
    }

    /**
     * @param RepositoryModel $repository
     * @return ProjectModel
     */
    public function removeRepository(RepositoryModel $repository) {
        $this->repositories->removeElement($repository);

        return $this;
    }

    /**
     * @param RepositoryModel $repository
     * @return boolean
     */
    public function hasRepository(RepositoryModel $repository) {
        return $this->repositories->contains($repository);
    }

    /**
     * @return ArrayCollection
     */
    public function getRepositories() {
        return $this->repositories;
    }
}
