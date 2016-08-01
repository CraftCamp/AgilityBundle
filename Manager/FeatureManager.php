<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Model\FeatureModel;

use Developtech\AgilityBundle\Entity\Feature;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Developtech\AgilityBundle\Utils\Slugger;

class FeatureManager {
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
    public function getProjectFeatures(ProjectModel $project) {
        return $this->em->getRepository(Feature::class)->findByProject($project);
    }

    /**
     * @param integer $id
     * @return FeatureModel
     */
    public function getFeature($id) {
        if(($feature = $this->em->getRepository(Feature::class)->find($id)) === null) {
            throw new NotFoundHttpException('Feature not found');
        }
        return $feature;
    }

    /**
    *  @param ProjectModel $project
     * @param string $name
     * @param string $description
     * @param integer $status
     * @param integer $productOwnerValue
     * @param UserInterface $developer
     * @return FeatureModel
     */
    public function createProductOwnerFeature(ProjectModel $project, $name, $description, $status, $productOwnerValue = null, $developer = null) {
        $feature =
            (new Feature())
            ->setProject($project)
            ->setType('product-owner')
            ->setName($name)
            ->setSlug($this->slugger->slugify($name))
            ->setDescription($description)
            ->setStatus($status)
            ->setProductOwnerValue($productOwnerValue)
            ->setDeveloper($developer)
        ;
        $project->addFeature($feature);
        $this->em->persist($feature);
        $this->em->flush();
        return $feature;
    }
}
