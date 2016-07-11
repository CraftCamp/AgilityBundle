<?php

namespace Developtech\AgilityBundle\Tests\Manager;

use Developtech\AgilityBundle\Manager\ProjectManager;

use Developtech\AgilityBundle\Tests\Mock\Project;

class ProjectManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var ProjectManager **/
    protected $manager;

    public function setUp() {
        $this->manager = new ProjectManager($this->getEntityManagerMock(), Project::class);
    }

    public function testGetProjects() {
        $projects = $this->manager->getProjects();

        $this->assertCount(3, $projects);
        $this->assertInstanceOf(Project::class, $projects[0]);
    }

    public function testGetProject() {
        $project = $this->manager->getProject('great-project');

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals(3, $project->getId());
        $this->assertEquals('Great project', $project->getName());
        $this->assertEquals('great-project', $project->getSlug());
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
            ->getMockBuilder('Developtech\AgilityBundle\Repository\ProjectRepository')
            ->disableOriginalConstructor()
            ->setMethods([
                'findOneBySlug',
                'findAll'
            ])
            ->getMock()
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findOneBySlug')
            ->willReturnCallback([$this, 'getProjectMock'])
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findAll')
            ->willReturnCallback([$this, 'getProjectsMock'])
        ;
        return $repositoryMock;
    }

    public function getProjectMock() {
        return
            (new Project())
            ->setId(3)
            ->setName('Great project')
            ->setSlug('great-project')
            ->setCreatedAt(new \DateTime())
            ->setNbBetaTesters(12)
            ->setBetaTestStatus('open')
            ->setProductOwner(new \StdClass)
        ;
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
