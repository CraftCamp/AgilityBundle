<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeedbackManager {
    /** @var EntityManager **/
    protected $em;
    /** @var string **/
    protected $feedbackClass;

    /**
     * @param EntityManager $em
     * @param string $feedbackClass
     */
    public function __construct(EntityManager $em, $feedbackClass) {
        $this->em = $em;
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
}
