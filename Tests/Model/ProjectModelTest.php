<?php

namespace Developtech\AgilityBundle\Tests\Model;

use Developtech\AgilityBundle\Tests\Mock\Project;
use Developtech\AgilityBundle\Tests\Mock\Feature;
use Developtech\AgilityBundle\Tests\Mock\Feedback;

class ProjectModelTest extends \PHPUnit_Framework_TestCase {
    public function testModel() {
        $feedback = new Feedback();
        $feature = new Feature();
        $entity =
            (new Project())
            ->setId(1)
            ->setName('Great project')
            ->setSlug('great-project')
            ->setCreatedAt(new \DateTime())
            ->setProductOwner((new \StdClass()))
            ->setBetaTestStatus('open')
            ->setNbBetaTesters(12)
            ->addFeature(new Feature())
            ->addFeature($feature)
            ->removeFeature($feature)
            ->addFeedback($feedback)
            ->addFeedback(new Feedback())
            ->removeFeedback($feedback)
        ;
        $this->assertEquals(1, $entity->getId());
        $this->assertEquals('Great project', $entity->getName());
        $this->assertEquals('great-project', $entity->getSlug());
        $this->assertInstanceOf('DateTime', $entity->getCreatedAt());
        $this->assertInstanceOf('StdClass', $entity->getProductOwner());
        $this->assertEquals('open', $entity->getBetaTestStatus());
        $this->assertEquals(12, $entity->getNbBetaTesters());
        $this->assertFalse($project->hasFeature($feature));
        $this->assertFalse($project->hasFeedback($feedback));
        $this->assertCount(1, $project->getFeedbacks());
        $this->assertCount(1, $project->getFeatures());
    }
}
