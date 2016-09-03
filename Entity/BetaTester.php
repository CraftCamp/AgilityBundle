<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\BetaTesterModel;

/**
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\BetaTesterRepository")
 * @ORM\Table(name="developtech_agility__beta_testers")
 * @ORM\HasLifecycleCallbacks()
 */
class BetaTester extends BetaTesterModel {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;
    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

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

    /**
     * @param integer $id
     * @return BetaTester
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
}
