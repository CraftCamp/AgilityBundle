<?php

namespace Developtech\AgilityBundle\Tests\Manager;

use Developtech\AgilityBundle\Manager\BetaTestManager;

use Developtech\AgilityBundle\Entity\BetaTest;
use Developtech\AgilityBundle\Entity\Project;

class BetaTestManagerTest extends \PHPUnit_Framework_TestCase {
    protected $manager;

    public function setUp() {
        $this->manager = new BetaTestManager($this->getEntityManagerMock());
    }

    public function testGetByProject() {
        $list = $this->manager->getByProject(new Project());

        $this->assertCount(2, $list);
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
            ->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findByProject'])
            ->getMock()
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findByProject')
            ->willReturnCallback([$this, 'getBetaTestsMock'])
        ;
        return $repositoryMock;
    }

    public function getBetaTestsMock(Project $project) {
        return [
            (new BetaTest())
            ->setId(1)
            ->setName('Wave #1')
            ->setSlug('wave-1')
            ->setProject($project),
            (new BetaTest())
            ->setId(2)
            ->setName('Wave #2')
            ->setSlug('wave-2')
            ->setProject($project),
        ];
    }
}
