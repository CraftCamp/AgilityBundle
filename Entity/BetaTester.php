<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\BetaTesterModel;

/**
 *
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\BetaTesterRepository")
 * @ORM\Table(name="developtech_agility__beta_testers")
 * @ORM\HasLifecycleCallbacks()
 */
class BetaTester extends BetaTesterModel {
    /**
     * @ORM\Id
     */
    protected $account;
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
}
