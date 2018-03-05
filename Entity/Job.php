<?php

namespace Developtech\AgilityBundle\Entity;

use Developtech\AgilityBundle\Model\JobModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="developtech_agility__jobs")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string", length=2)
 * @ORM\DiscriminatorMap({
 *     "US" = "Feature",
 *     "FB" = "Feedback"
 * })
 * @ORM\HasLifecycleCallbacks
 */
abstract class Job extends JobModel {
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
     * @ORM\ManyToOne(targetEntity="Developtech\AgilityBundle\Model\ProjectModel", inversedBy="feedbacks")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", onDelete="CASCADE")
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
