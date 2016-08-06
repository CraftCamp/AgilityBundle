<?php

namespace Developtech\AgilityBundle\Manager;

use Developtech\AgilityBundle\Model\ProjectModel;

use Developtech\AgilityBundle\Entity\Feature;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeatureManager extends JobManager {
    /**
     * @param ProjectModel $project
     * @return array
     */
    public function getProjectFeatures(ProjectModel $project) {
        return $this->em->getRepository(Feature::class)->findByProject($project);
    }

    /**
     * @param integer $id
     * @return Feature
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
     * @param UserInterface $responsible
     * @return Feature
     */
    public function createProductOwnerFeature(ProjectModel $project, $name, $description, $status, $productOwnerValue = null, $responsible = null) {
        $feature =
            (new Feature())
            ->setProject($project)
            ->setFeatureType(Feature::FEATURE_TYPE_PRODUCT_OWNER)
            ->setName($name)
            ->setSlug($this->slugger->slugify($name))
            ->setDescription($description)
            ->setStatus($status)
            ->setProductOwnerValue($productOwnerValue)
            ->setResponsible($responsible)
        ;
        $project->addFeature($feature);
        $this->em->persist($feature);
        $this->em->flush();
        return $feature;
    }
}
