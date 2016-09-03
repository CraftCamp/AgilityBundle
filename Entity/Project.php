<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\ProjectModel;

/**
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\ProjectRepository")
 * @ORM\Table(name="developtech_agility__projects")
 * @ORM\HasLifecycleCallbacks()
 */
class Project extends ProjectModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
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
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Developtech\AgilityBundle\Entity\BetaTest", mappedBy="project")
     */
    protected $betaTests;

    /**
     * @ORM\OneToMany(targetEntity="Developtech\AgilityBundle\Entity\Feature", mappedBy="project")
     */
    protected $features;

    /**
     * @ORM\OneToMany(targetEntity="Developtech\AgilityBundle\Entity\Feedback", mappedBy="project")
     */
    protected $feedbacks;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate() {
        $this->updatedAt = new \DateTime();
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
