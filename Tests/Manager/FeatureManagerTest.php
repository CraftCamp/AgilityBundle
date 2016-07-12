<?php

namespace Developtech\AgilityBundle\Tests\Manager;

use Developtech\AgilityBundle\Manager\FeatureManager;

use Developtech\AgilityBundle\Tests\Mock\Feature;
use Developtech\AgilityBundle\Tests\Mock\User;
use Developtech\AgilityBundle\Tests\Mock\Project;

class FeatureManagerTest extends \PHPUnit_Framework_TestCase {
    protected $manager;

    public function setUp() {
        $this->manager = new FeatureManager($this->getEntityManagerMock(), Feature::class);
    }

    public function testGetProjectFeatures() {
        $features = $this->manager->getProjectFeatures((new Project()));

        $this->assertCount(3, $features);
        $this->assertInstanceOf(Feature::class, $features[0]);
        $this->assertEquals(2, $features[1]->getId());
    }

    public function getEntityManagerMock() {
        $entityManagerMock = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $entityManagerMock
            ->expects($this->any())
            ->method('getRepository')
            ->willReturnCallback([$this, 'getRepositoryMock'])
        ;
        return $entityManagerMock;
    }

    public function getRepositoryMock() {
        $repositoryMock = $this
            ->getMockBuilder('Developtech\AgilityBundle\Repository\FeatureRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findByProject'])
            ->getMock()
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findByProject')
            ->willReturnCallback([$this, 'getFeaturesMock'])
        ;
        return $repositoryMock;
    }

    public function getFeaturesMock() {
        return [
            (new Feature())
            ->setId(1)
            ->setName('Calendar creation')
            ->setSlug('calendar-creation')
            ->setDescription('Create a new calendar')
            ->setProject(new Project())
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
            (new Feature())
            ->setId(2)
            ->setName('Calendar edition')
            ->setSlug('calendar-edition')
            ->setDescription('Edit an existing calendar')
            ->setProject(new Project())
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
            (new Feature())
            ->setId(3)
            ->setName('Calendar removal')
            ->setSlug('calendar-removal')
            ->setDescription('Remove an existing calendar')
            ->setProject(new Project())
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
        ];
    }
}