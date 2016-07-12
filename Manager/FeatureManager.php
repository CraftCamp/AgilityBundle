<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;

use Developtech\AgilityBundle\Model\ProjectModel;

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
}
