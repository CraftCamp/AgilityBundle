<?php

namespace DevelopTech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="DevelopTech\AgilityBundle\Repository\ProjectRepository")
 */
class Project
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
     * @param integer $id
     * @return Project
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * @return Project
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
}
