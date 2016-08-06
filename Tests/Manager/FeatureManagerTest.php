<?php

namespace Developtech\AgilityBundle\Tests\Manager;

use Developtech\AgilityBundle\Manager\FeatureManager;

use Developtech\AgilityBundle\Entity\Feature;
use Developtech\AgilityBundle\Tests\Mock\User;
use Developtech\AgilityBundle\Entity\Project;

use Developtech\AgilityBundle\Utils\Slugger;

class FeatureManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var FeatureManager **/
    protected $manager;

    public function setUp() {
        $this->manager = new FeatureManager($this->getEntityManagerMock(), new Slugger(), Feature::class);
    }

    public function testGetFeature() {
        $feature = $this->manager->getFeature(1);

        $this->assertInstanceOf(Feature::class, $feature);
        $this->assertEquals(1, $feature->getId());
        $this->assertEquals('Calendar creation', $feature->getName());
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage Feature not found
     */
    public function testGetFeatureWithUnexistingFeature() {
        $this->manager->getFeature(2);
    }

    public function testGetProjectFeatures() {
        $features = $this->manager->getProjectFeatures((new Project()));

        $this->assertCount(3, $features);
        $this->assertInstanceOf(Feature::class, $features[0]);
        $this->assertEquals(2, $features[1]->getId());
    }

    public function testCreateProductOwnerFeature() {
        $feature = $this->manager->createProductOwnerFeature(
            (new Project()),
            'Todo list',
            'List of all the remaining actions to perform',
            Feature::STATUS_READY,
            95
        );
        $this->assertInstanceOf(Feature::class, $feature);
        $this->assertInstanceOf(Project::class, $feature->getProject());
        $this->assertEquals('Todo list', $feature->getName());
        $this->assertEquals('todo-list', $feature->getSlug());
        $this->assertEquals('List of all the remaining actions to perform', $feature->getDescription());
        $this->assertEquals(Feature::STATUS_READY, $feature->getStatus());
        $this->assertEquals(95, $feature->getProductOwnerValue());
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
        $entityManagerMock
            ->expects($this->any())
            ->method('persist')
            ->willReturn(true)
        ;
        $entityManagerMock
            ->expects($this->any())
            ->method('flush')
            ->willReturn(true)
        ;
        return $entityManagerMock;
    }

    public function getRepositoryMock() {
        $repositoryMock = $this
            ->getMockBuilder('Developtech\AgilityBundle\Repository\FeatureRepository')
            ->disableOriginalConstructor()
            ->setMethods([
                'find',
                'findByProject'
            ])
            ->getMock()
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('find')
            ->willReturnCallback([$this, 'getFeatureMock'])
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findByProject')
            ->willReturnCallback([$this, 'getFeaturesMock'])
        ;
        return $repositoryMock;
    }

    public function getFeatureMock($id) {
        if($id === 2) {
            return null;
        }
        return
            (new Feature())
            ->setId(1)
            ->setName('Calendar creation')
            ->setSlug('calendar-creation')
            ->setDescription('Create a new calendar')
            ->setProject(new Project())
            ->setResponsible(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;
    }

    public function getFeaturesMock() {
        return [
            (new Feature())
            ->setId(1)
            ->setName('Calendar creation')
            ->setSlug('calendar-creation')
            ->setDescription('Create a new calendar')
            ->setProject(new Project())
            ->setResponsible(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
            (new Feature())
            ->setId(2)
            ->setName('Calendar edition')
            ->setSlug('calendar-edition')
            ->setDescription('Edit an existing calendar')
            ->setProject(new Project())
            ->setResponsible(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
            (new Feature())
            ->setId(3)
            ->setName('Calendar removal')
            ->setSlug('calendar-removal')
            ->setDescription('Remove an existing calendar')
            ->setProject(new Project())
            ->setResponsible(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
        ];
    }
}
