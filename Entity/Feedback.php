<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Developtech\AgilityBundle\Model\FeedbackModel;

/**
 * Feedback
 *
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\FeedbackRepository")
 * @ORM\Table(name="developtech_agility__feedbacks")
 * @ORM\HasLifecycleCallbacks()
 */
class Feedback extends FeedbackModel {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=125)
     */
    protected $name;

    /**
     * @ORM\Column(name="slug", type="string", length=125)
     */
    protected $slug;

    /**
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $description;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    protected $updatedAt;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Developtech\AgilityBundle\Entity\Project", inversedBy="feedbacks")
     */
    protected $project;

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
     * @return FeedbackModel
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