<?php

namespace Developtech\AgilityBundle\Tests\Model;

use Developtech\AgilityBundle\Entity\Feedback;
use Developtech\AgilityBundle\Entity\Feature;
use Developtech\AgilityBundle\Entity\BetaTest;
use Developtech\AgilityBundle\Entity\Project;
use Developtech\AgilityBundle\Tests\Mock\User;

class ProjectTest extends \PHPUnit_Framework_TestCase {
    public function testModel() {
        $feedback = new Feedback();
        $feature = new Feature();
        $betaTest = new BetaTest();
        $project =
            (new Project())
            ->setId(1)
            ->setName('Great project')
            ->setSlug('great-project')
            ->setCreatedAt(new \DateTime())
            ->setProductOwner((new User()))
            ->addBetaTest(new BetaTest())
            ->addBetaTest($betaTest)
            ->removeBetaTest($betaTest)
            ->addFeature(new Feature())
            ->addFeature($feature)
            ->removeFeature($feature)
            ->addFeedback($feedback)
            ->addFeedback(new Feedback())
            ->removeFeedback($feedback)
        ;
        $this->assertEquals(1, $project->getId());
        $this->assertEquals('Great project', $project->getName());
        $this->assertEquals('great-project', $project->getSlug());
        $this->assertInstanceOf('DateTime', $project->getCreatedAt());
        $this->assertInstanceOf(User::class, $project->getProductOwner());
        $this->assertFalse($project->hasFeature($feature));
        $this->assertFalse($project->hasFeedback($feedback));
        $this->assertCount(1, $project->getFeedbacks());
        $this->assertCount(1, $project->getFeatures());
        $this->assertCount(1, $project->getBetaTests());
    }
}
