<?php

namespace Developtech\AgilityBundle\Model;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
abstract class ProjectModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=125, unique=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=125, unique=true)
     */
    protected $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="nbBetaTesters", type="integer")
     */
    protected $nbBetaTesters;

    /**
     * @var string
     *
     * @ORM\Column(name="betaTestStatus", type="string", length=12)
     */
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

    public function __construct() {
        $this->features = new ArrayCollection();
    }

    /**
     * @param integer $id
     * @return Project
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
}
