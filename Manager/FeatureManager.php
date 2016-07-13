<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;
use Developtech\AgilityBundle\Model\FeatureModel;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeatureManager {
    /** @var EntityManager **/
    protected $em;
    /** @var string **/
    protected $featureClass;

    /**
     * @param EntityManager $em
     * @param string $featureClass
     */
    public function __construct(EntityManager $em, $featureClass) {
        $this->em = $em;
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
}
