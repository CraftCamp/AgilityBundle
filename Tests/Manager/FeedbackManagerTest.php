<?php

namespace Developtech\AgilityBundle\Tests\Manager;

use Developtech\AgilityBundle\Manager\FeedbackManager;

use Developtech\AgilityBundle\Entity\Feedback;
use Developtech\AgilityBundle\Tests\Mock\User;
use Developtech\AgilityBundle\Entity\Project;

use Developtech\AgilityBundle\Utils\Slugger;

class FeedbackManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var FeedbackManager **/
    protected $manager;

    public function setUp() {
        $this->manager = new FeedbackManager($this->getEntityManagerMock(), new Slugger(), Feedback::class);
    }

    public function testGetProjectFeedbacks() {
        $feedbacks = $this->manager->getProjectFeedbacks((new Project()));

        $this->assertCount(2, $feedbacks);
        $this->assertInstanceOf(Feedback::class, $feedbacks[0]);
        $this->assertEquals(2, $feedbacks[1]->getId());
    }

    public function testGetProjectFeedbacksByAuthor() {
        $feedbacks = $this->manager->getProjectFeedbacksByAuthor(new Project(), new User('Hagrid'));

        $this->assertCount(2, $feedbacks);
        $this->assertInstanceOf(Feedback::class, $feedbacks[0]);
        $this->assertEquals(2, $feedbacks[1]->getId());
        $this->assertEquals('Hagrid', $feedbacks[0]->getAuthor()->getUsername());
        $this->assertEquals('Hagrid', $feedbacks[1]->getAuthor()->getUsername());
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

    public function testCreateFeedback() {
        $feedback = $this->manager->createFeedback(
            (new Project()),
            'There is a bug in the kitchen',
            'The fridge is hotter than my computer !',
            (new User())
        );
        $this->assertInstanceOf(Feedback::class, $feedback);
        $this->assertInstanceOf(Project::class, $feedback->getProject());
        $this->assertEquals('There is a bug in the kitchen', $feedback->getName());
        $this->assertEquals('there-is-a-bug-in-the-kitchen', $feedback->getSlug());
        $this->assertEquals('The fridge is hotter than my computer !', $feedback->getDescription());
        $this->assertInstanceOf(User::class, $feedback->getAuthor());
        $this->assertEquals(Feedback::STATUS_OPEN, $feedback->getStatus());
    }

    public function testCountFeedbacksPerStatus() {
        $this->assertEquals(3, $this->manager->countFeedbacksPerStatus((new Project())->setId(1), Feedback::STATUS_OPEN));
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
            ->getMockBuilder('Developtech\AgilityBundle\Repository\FeedbackRepository')
            ->disableOriginalConstructor()
            ->setMethods([
                'find',
                'findBy',
                'findByProject',
                'countPerStatus'
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
            ->method('findBy')
            ->willReturnCallback([$this, 'getFeedbacksWithAuthorMock'])
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('find')
            ->willReturnCallback([$this, 'getFeedbackMock'])
        ;
        $repositoryMock
            ->expects($this->any())
            ->method('countPerStatus')
            ->willReturn(3)
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

    public function getFeedbacksWithAuthorMock() {
        return [
            (new Feedback())
            ->setId(1)
            ->setName('I can\'t see the calendar')
            ->setSlug('i-can-t-see-the-calendar')
            ->setDescription('Add brightness to this calendar !')
            ->setProject(new Project())
            ->setAuthor(new User('Hagrid'))
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
            (new Feedback())
            ->setId(2)
            ->setName('The calendar is not shiny enough')
            ->setSlug('the-calendar-is-not-shiny-enough')
            ->setDescription('This calendar blew my eyes away !')
            ->setProject(new Project())
            ->setAuthor(new User('Hagrid'))
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime()),
        ];
    }
}
