<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\FeatureRepository")
 * @ORM\Table(name="developtech_agility__features")
 * @ORM\HasLifecycleCallbacks()
 */
class Feature extends Job {
    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $featureType;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $productOwnerValue;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $userValue;

    const FEATURE_TYPE_PRODUCT_OWNER = 'product-owner';
    const FEATURE_TYPE_USER = 'user';

    const STATUS_TO_SPECIFY = 0;
    const STATUS_TO_VALORIZE = 1;
    const STATUS_READY = 2;
    const STATUS_TO_DO = 3;
    const STATUS_IN_PROGRESS = 4;
    const STATUS_TO_VALIDATE = 5;
    const STATUS_TO_DEPLOY = 6;

    /**
     * @return string
     */
    public function getType() {
        return self::TYPE_FEATURE;
    }

    /**
     * @param string $featureType
     * @return FeatureModel
     */
    public function setFeatureType($featureType) {
        $this->featureType = $featureType;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureType() {
        return $this->featureType;
    }

    /**
     * @param integer $productOwnerValue
     * @return FeatureModel
     */
    public function setProductOwnerValue($productOwnerValue) {
        $this->productOwnerValue = $productOwnerValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getProductOwnerValue() {
        return $this->productOwnerValue;
    }

    /**
     * @var integer $userValue
     * @return FeatureModel
     */
    public function setUserValue($userValue) {
        $this->userValue = $userValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserValue() {
        return $this->userValue;
    }
}
