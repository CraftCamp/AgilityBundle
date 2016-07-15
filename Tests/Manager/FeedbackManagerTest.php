<?php

namespace Developtech\AgilityBundle\Tests\Manager;

use Developtech\AgilityBundle\Manager\FeedbackManager;

use Developtech\AgilityBundle\Tests\Mock\Feedback;
use Developtech\AgilityBundle\Tests\Mock\User;
use Developtech\AgilityBundle\Tests\Mock\Project;

class FeedbackManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var FeedbackManager **/
    protected $manager;

    public function setUp() {
        $this->manager = new FeedbackManager($this->getEntityManagerMock(), Feature::class);
    }

    public function testGetProjectFeedbacks() {
        $feedbacks = $this->manager->getProjectFeedbacks((new Project()));

        $this->assertCount(2, $feedbacks);
        $this->assertInstanceOf(Feedback::class, $feedbacks[0]);
        $this->assertEquals(2, $feedbacks[1]->getId());
    }

    public function testGetFeedback() {
        $feedback = $this->manager->getFeedback(1);

        $this->assertInstanceOf(Feedback::class, $feedback);
        $this->assertEquals(1, $feedback->getId());
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage Feedback not found
     */
    public function testGetFeedbackWithUnexistingFeedback() {
        $this->manager->getFeedback(2);
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
            ->getMockBuilder('Developtech\AgilityBundle\Repository\FeedbackRepository')
            ->disableOriginalConstructor()
            ->setMethods([
                'find',
                'findByProject'
            ])
            ->getMock()
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('findByProject')
            ->willReturnCallback([$this, 'getFeedbacksMock'])
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('find')
            ->willReturnCallback([$this, 'getFeedbackMock'])
        ;
        return $repositoryMock;
    }

    public function getFeedbackMock($id) {
        if($id === 2) {
            return null;
        }
        return
            (new Feedback())
            ->setId(1)
            ->setName('I can\'t see the calendar')
            ->setSlug('i-can-t-see-the-calendar')
            ->setDescription('Add brightness to this calendar !')
            ->setProject(new Project())
            ->setAuthor(new User())
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;
    }

    public function getFeedbacksMock() {
        return [
            (new Feedback())
            ->setId(1)
            ->setName('I can\'t see the calendar')
            ->setSlug('i-can-t-see-the-calendar')
            ->setDescription('Add brightness to this calendar !')
            ->setProject(new Project())
            ->setAuthor(new User())
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
            (new Feedback())
            ->setId(2)
            ->setName('The calendar is not shiny enough')
            ->setSlug('the-calendar-is-not-shiny-enough')
            ->setDescription('This calendar blew my eyes away !')
            ->setProject(new Project())
            ->setAuthor(new User())
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
        ];
    }
}
