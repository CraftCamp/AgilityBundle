<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\BetaTestModel;

/**
 * @ORM\Entity(repositoryClass="DevelopTech\AgilityBundle\Repository\BetaTestRepository")
 * @ORM\Table(name="developtech_agility__beta_tests")
 * @ORM\HasLIfecycleCallbacks()
 */
class BetaTest extends BetaTestModel {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;
    /**
     * @ORM\OneToMany(targetEntity="Developtech\AgilityBundle\Entity\Project", mappedBy="betaTests")
     */
    protected $project;
    /**
     * @ORM\Column(name="started_at", type="datetime")
     */
    protected $startedAt;
    /**
     * @ORM\Column(name="ended_at", type="datetime")
     */
    protected $endedAt;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;
    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
    /**
     * @ORM\ManyToMany(targetEntity="Developtech\AgilityBundle\Entity\BetaTester")
     */
    protected $betaTesters;

    /**
     * @param integer $id
     * @return BetaTest
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
