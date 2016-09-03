<?php

namespace Developtech\AgilityBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class BetaTestModel {
    /** @var string **/
    protected $name;
    /** @var string **/
    protected $slug;
    /** @var ProjectModel **/
    protected $project;
    /** @var \DateTime **/
    protected $startedAt;
    /** @var \DateTime **/
    protected $endedAt;
    /** @var \DateTime **/
    protected $createdAt;
    /** @var \DateTime **/
    protected $updatedAt;
    /** @var ArrayCollection **/
    protected $betaTesters;

    public function __construct() {
        $this->betaTesters = new ArrayCollection();
    }

    /**
     * @param string $name
     * @return BetaTestModel
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
     * @return BetaTestModel
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
     * @param ProjectModel $project
     * @return BetaTestModel
     */
    public function setProject(ProjectModel $project) {
        $this->project = $project;

        return $this;
    }

    /**
     * @return ProjectModel
     */
    public function getProject() {
        return $this->project;
    }

    /**
     * @param \DateTime $startedAt
     * @return BetaTestModel
     */
    public function setStartedAt(\DateTime $startedAt) {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt() {
        return $this->startedAt;
    }

    /**
     * @param \DateTime $endedAt
     * @return BetaTestModel
     */
    public function setEndedAt(\DateTime $endedAt) {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndedAt() {
        return $this->endedAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return BetaTestModel
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return BetaTestModel
     */
    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @param BetaTesterModel $betaTester
     * @return BetaTestModel
     */
    public function addBetaTester(BetaTesterModel $betaTester) {
        $this->betaTesters->add($betaTester);

        return $this;
    }

    /**
     * @param BetaTesterModel $betaTester
     * @return BetaTestModel
     */
    public function removeBetaTester(BetaTesterModel $betaTester) {
        $this->betaTesters->removeElement($betaTester);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBetaTesters() {
        return $this->betaTesters;
    }
}
