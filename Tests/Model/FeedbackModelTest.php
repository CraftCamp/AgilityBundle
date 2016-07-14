<?php

namespace Developtech\AgilityBundle\Tests\Model;

use Developtech\AgilityBundle\Tests\Mock\Feedback;
use Developtech\AgilityBundle\Tests\Mock\Project;
use Developtech\AgilityBundle\Tests\Mock\User;

class FeedbackModelTest extends \PHPUnit_Framework_TestCase {
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
            ->setDeveloper(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;
    }
}
