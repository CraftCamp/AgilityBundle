<?php

namespace Developtech\AgilityBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

class DynamicRelationSubscriber implements EventSubscriber
{
    const MODEL_PROJECT = 'Developtech\AgilityBundle\Entity\Project';
    const MODEL_FEATURE = 'Developtech\AgilityBundle\Entity\Feature';
    const MODEL_FEEDBACK = 'Developtech\AgilityBundle\Entity\Feedback';

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

        $namingStrategy = $eventArgs
            ->getEntityManager()
            ->getConfiguration()
            ->getNamingStrategy()
        ;

        switch($metadata->getName()) {
            case self::MODEL_PROJECT: return $this->mapProject($metadata, $namingStrategy);
            case self::MODEL_FEATURE: return $this->mapFeature($metadata, $namingStrategy);
            case self::MODEL_FEEDBACK: return $this->mapFeedback($metadata, $namingStrategy);
            default: return;
        }
    }

    /**
     * @param CLassMetadata $metadata
     * @param UnderscoreNamingStrategy $namingStrategy
     */
    public function mapProject(ClassMetadata $metadata, UnderscoreNamingStrategy $namingStrategy) {
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'productOwner',
            'cascade'       => array(),
            'joinColumn'    => array(
                'nullable' => false
            )
        ));
    }

    /**
     * @param CLassMetadata $metadata
     * @param UnderscoreNamingStrategy $namingStrategy
     */
    public function mapFeature(ClassMetadata $metadata, UnderscoreNamingStrategy $namingStrategy) {
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'developer',
            'cascade'       => array(),
            'joinColumn'    => array(
                'nullable' => true
            )
        ));
    }

    /**
     * @param CLassMetadata $metadata
     * @param UnderscoreNamingStrategy $namingStrategy
     */
    public function mapFeedback(ClassMetadata $metadata, UnderscoreNamingStrategy $namingStrategy) {
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'author',
            'cascade'       => array(),
            'joinColumn'    => array(
                'nullable' => false
            )
        ));
        $metadata->mapManyToOne(array(
            'targetEntity'  => $this->userClass,
            'fieldName'     => 'developer',
            'cascade'       => array(),
            'joinColumn'    => array(
                'nullable' => true
            )
        ));
    }
}
