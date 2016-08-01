<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\FeatureModel;

/**
 * Feedback
 *
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\FeatureRepository")
 * @ORM\Table(name="developtech_agility__features")
 * @ORM\HasLifecycleCallbacks()
 */
class Feature extends FeatureModel {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $productOwnerValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $userValue;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Developtech\AgilityBundle\Entity\Project", inversedBy="features")
     */
    protected $project;

    /**
     * @param integer $id
     * @return FeatureModel
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate() {
        $this->updatedAt = new \DateTime();
    }
}
