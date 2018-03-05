<?php

namespace Developtech\AgilityBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;

use Developtech\AgilityBundle\Entity\{
    BetaTester,
    Feature,
    Feedback,
    Project
};

class DynamicRelationSubscriber implements EventSubscriber
{
    const MODEL_PROJECT = Project::class;
    const MODEL_FEATURE = Feature::class;
    const MODEL_FEEDBACK = Feedback::class;
    const MODEL_BETA_TESTER = BetaTester::class;

    /** @var string **/
    protected $userClass;

    /**
     * @param string $userClass
     */
    public function __construct($userClass) {
        $this->userClass = $userClass;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        // the $metadata is the whole mapping info for this class
        $metadata = $eventArgs->getClassMetadata();

        switch($metadata->getName()) {
            case self::MODEL_PROJECT: return $this->mapProject($metadata);
            case self::MODEL_FEATURE: return $this->mapFeature($metadata);
            case self::MODEL_FEEDBACK: return $this->mapFeedback($metadata);
            case self::MODEL_BETA_TESTER: return $this->mapBetaTester($metadata);
            default: return;
        }
    }

    /**
     * @param CLassMetadata $metadata
     */
    public function mapProject(ClassMetadata $metadata) {
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'productOwner',
            'cascade'       => array(),
            'joinColumn'    => array(
                'name' => 'product_owner_id',
                'referencedColumnName' => 'id',
                'onDelete' => 'SET NULL',
                'nullable' => true
            )
        ));
    }

    /**
     * @param CLassMetadata $metadata
     */
    public function mapFeature(ClassMetadata $metadata) {
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'responsible',
            'cascade'       => array(),
            'joinColumn'    => array(
                'name' => 'responsible_id',
                'referencedColumnName' => 'id',
                'onDelete' => 'SET NULL',
                'nullable' => true
            )
        ));
    }

    /**
     * @param CLassMetadata $metadata
     */
    public function mapFeedback(ClassMetadata $metadata) {
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'author',
            'cascade'       => array(),
            'joinColumn'    => array(
                'name' => 'author_id',
                'referencedColumnName' => 'id',
                'onDelete' => 'CASCADE',
                'nullable' => false
            )
        ));
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'responsible',
            'cascade'       => array(),
            'joinColumn'    => array(
                'name' => 'responsible_id',
                'referencedColumnName' => 'id',
                'onDelete' => 'SET NULL',
                'nullable' => true
            )
        ));
    }

    /**
     * @param CLassMetadata $metadata
     */
    public function mapBetaTester(ClassMetadata $metadata) {
        $metadata->mapOnetoOne([
            'targetEntity' => $this->userClass,
            'fieldName' => 'account',
            'cascade' => [],
            'joinColumn' => [
                'name' => 'account_id',
                'referencedColumnName' => 'id',
                'onDelete' => 'CASCADE',
                'nullable' => false
            ]
        ]);
    }
}
