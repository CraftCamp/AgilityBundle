<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Model\FeedbackModel;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Developtech\AgilityBundle\Utils\Slugger;

use Symfony\Component\Security\Core\User\UserInterface;

class FeedbackManager {
    /** @var EntityManager **/
    protected $em;
    /** @var Slugger **/
    protected $slugger;
    /** @var string **/
    protected $feedbackClass;

    /**
     * @param EntityManager $em
     * @param Slugger $slugger
     * @param string $feedbackClass
     */
    public function __construct(EntityManager $em, Slugger $slugger, $feedbackClass) {
        $this->em = $em;
        $this->slugger = $slugger;
        $this->feedbackClass = $feedbackClass;
    }

    /**
     * @param ProjectModel $project
     * @return array
     */
    public function getProjectFeedbacks(ProjectModel $project) {
        return $this->em->getRepository($this->feedbackClass)->findByProject($project);
    }

    /**
     * @param integer $id
     * @return FeedbackModel
     */
    public function getFeedback($id) {
        if(($feedback = $this->em->getRepository($this->feedbackClass)->find($id)) === null) {
            throw new NotFoundHttpException('Feedback not found');
        }
        return $feedback;
    }

    /**
     * @param ProjectModel $project
     * @param string $name
     * @param string $description
     * @param UserInterface $author
     * @return FeedbackModel
     */
    public function createFeedback(ProjectModel $project, $name, $description, UserInterface $author) {
        $feedback =
            (new $this->feedbackClass())
            ->setName($name)
            ->setSlug($this->slugger->slugify($name))
            ->setDescription($description)
            ->setProject($project)
            ->setAuthor($author)
            ->setStatus(FeedbackModel::STATUS_OPEN)
        ;
        $this->em->persist($feedback);
        $this->em->flush();
        return $feedback;
    }
}
