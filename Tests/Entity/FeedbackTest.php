<?php

namespace Developtech\AgilityBundle\Tests\Model;

use Developtech\AgilityBundle\Entity\Feedback;
use Developtech\AgilityBundle\Entity\Project;
use Developtech\AgilityBundle\Tests\Mock\User;

class FeedbackTest extends \PHPUnit_Framework_TestCase {
    public function testEntity() {
        $feedback =
            (new Feedback())
            ->setId(1)
            ->setName('Add licensee to your application !')
            ->setSlug('add-licensee-to-your-application')
            ->setDescription('The licensee is mandatory for any website. You must add it to yours.')
            ->setStatus(Feedback::STATUS_TO_DO)
            ->setProject(new Project())
            ->setAuthor((new User()))
            ->setResponsible(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;
        $this->assertEquals(1, $feedback->getId());
        $this->assertEquals(Feedback::TYPE_FEEDBACK, $feedback->getType());
        $this->assertEquals('Add licensee to your application !', $feedback->getName());
        $this->assertEquals('add-licensee-to-your-application', $feedback->getSlug());
        $this->assertEquals(Feedback::STATUS_TO_DO, $feedback->getStatus());
        $this->assertInstanceOf(Project::class, $feedback->getProject());
        $this->assertInstanceOf(User::class, $feedback->getAuthor());
        $this->assertInstanceOf(User::class, $feedback->getResponsible());
        $this->assertInstanceOf('DateTime', $feedback->getCreatedAt());
        $this->assertInstanceOf('DateTime', $feedback->getUpdatedAt());
    }
}
