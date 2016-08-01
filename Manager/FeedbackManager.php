<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Model\FeedbackModel;

use Developtech\AgilityBundle\Entity\Feedback;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Developtech\AgilityBundle\Utils\Slugger;

use Symfony\Component\Security\Core\User\UserInterface;

class FeedbackManager {
    /** @var EntityManager **/
    protected $em;
    /** @var Slugger **/
    protected $slugger;

    /**
     * @param EntityManager $em
     * @param Slugger $slugger
     */
    public function __construct(EntityManager $em, Slugger $slugger) {
        $this->em = $em;
        $this->slugger = $slugger;
    }

    /**
     * @param ProjectModel $project
     * @return array
     */
    public function getProjectFeedbacks(ProjectModel $project) {
        return $this->em->getRepository(Feedback::class)->findByProject($project);
    }

    /**
    * @param ProjectModel $project
    * @param UserInterface $author
    * @param array $orderBy
    * @param integer $limit
    * @param integer $offset
    * @return array
    */
    public function getProjectFeedbacksByAuthor(ProjectModel $project, UserInterface $author, $orderBy = null, $limit = null, $offset = null) {
        return $this->em->getRepository(Feedback::class)->findBy([
            'project' => $project,
            'author' => $author
        ], $orderBy, $limit, $offset);
    }

    /**
     * @param integer $id
     * @return FeedbackModel
     */
    public function getFeedback($id) {
        if(($feedback = $this->em->getRepository(Feedback::class)->find($id)) === null) {
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
            (new Feedback())
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

    /**
     * @param ProjectModel $project
     * @param integer $status
     * @return integer
     */
    public function countFeedbacksPerStatus(ProjectModel $project, $status) {
        return $this->em->getRepository(Feedback::class)->countPerStatus($project, $status);
    }
}
