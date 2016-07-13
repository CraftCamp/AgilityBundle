<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Model\FeatureModel;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Developtech\AgilityBundle\Utils\Slugger;

class FeatureManager {
    /** @var EntityManager **/
    protected $em;
    /** @var Slugger **/
    protected $slugger;
    /** @var string **/
    protected $featureClass;

    /**
     * @param EntityManager $em
     * @param string $featureClass
     */
    public function __construct(EntityManager $em, Slugger $slugger, $featureClass) {
        $this->em = $em;
        $this->slugger = $slugger;
        $this->featureClass = $featureClass;
    }

    /**
     * @param ProjectModel $project
     * @return array
     */
    public function getProjectFeatures(ProjectModel $project) {
        return $this->em->getRepository($this->featureClass)->findByProject($project);
    }

    /**
     * @param integer $id
     * @return FeatureModel
     */
    public function getFeature($id) {
        if(($feature = $this->em->getRepository($this->featureClass)->find($id)) === null) {
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
            (new $this->featureClass())
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
