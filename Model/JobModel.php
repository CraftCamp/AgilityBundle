<?php

namespace Developtech\AgilityBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class JobModel {
  /** @var string */
  protected $name;
  /** @var string */
  protected $slug;
  /** @var string*/
  protected $description;
  /** @var \DateTime*/
  protected $createdAt;
  /** @var \DateTime */
  protected $updatedAt;
  /** @var integer */
  protected $status;
  /** @var ProjectModel */
  protected $project;
  /** @var object */
  protected $responsible;

  const TYPE_FEATURE = 'US';
  const TYPE_FEEDBACK = 'FB';

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
   * @param UserInterface $responsible
   * @return FeatureModel
   */
  public function setResponsible(UserInterface $responsible = null) {
      $this->responsible = $responsible;

      return $this;
  }

  /**
   * @return object
   */
  public function getResponsible() {
      return $this->responsible;
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
