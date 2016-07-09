<?php

namespace DevelopTech\AgilityBundle\Tests\Manager;

use DevelopTech\AgilityBundle\Manager\ProjectManager;

use DevelopTech\AgilityBundle\Entity\Project;

class ProjectManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var ProjectManager **/
    protected $manager;

    public function setUp() {
        $this->manager = new ProjectManager($this->getEntityManagerMock());
    }

    public function testGetProjects() {
        $projects = $this->manager->getProjects();

        $this->assertCount(3, $projects);
        $this->assertInstanceOf(Project::class, $projects[0]);
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
            ->getMockBuilder('DevelopTech\AgilityBundle\Repository\ProjectRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findAll')
            ->willReturnCallback([$this, 'getProjectsMock'])
        ;
        return $repositoryMock;
    }

    public function getProjectsMock() {
        return  [
            (new Project())
            ->setName('Great Project')
            ->setSlug('great-project')
            ->setCreatedAt(new \DateTime())
            ->setNbBetaTesters(12)
            ->setBetaTestStatus('open'),
            (new Project())
            ->setName('Bloody Project')
            ->setSlug('bloody-project')
            ->setCreatedAt(new \DateTime())
            ->setNbBetaTesters(17)
            ->setBetaTestStatus('closed'),
            (new Project())
            ->setName('Messy Project')
            ->setSlug('messy-project')
            ->setCreatedAt(new \DateTime())
            ->setNbBetaTesters(24)
            ->setBetaTestStatus('closed'),
        ];
    }
}
