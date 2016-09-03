<?php

namespace Developtech\AgilityBundle\Tests\Entity;

use Developtech\AgilityBundle\Entity\BetaTest;
use Developtech\AgilityBundle\Entity\BetaTester;
use Developtech\AgilityBundle\Entity\Project;

class BetaTestTest extends \PHPUnit_Framework_TestCase {
    public function testEntity() {
        $betaTester = new BetaTester();
        $betaTest =
            (new BetaTest)
            ->setId(1)
            ->setName('Wave #2')
            ->setSlug('wave-2')
            ->setProject(new Project())
            ->addBetaTester(new BetaTester())
            ->addBetaTester($betaTester)
            ->removeBetaTester($betaTester)
            ->setStartedAt(new \DateTime())
            ->setEndedAt(new \DateTime())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;
        $this->assertEquals(1, $betaTest->getId());
        $this->assertEquals('Wave #2', $betaTest->getName());
        $this->assertEquals('wave-2', $betaTest->getSlug());
        $this->assertInstanceOf(Project::class, $betaTest->getProject());
        $this->assertInstanceOf('DateTime', $betaTest->getStartedAt());
        $this->assertInstanceOf('DateTime', $betaTest->getEndedAt());
        $this->assertInstanceOf('DateTime', $betaTest->getCreatedAt());
        $this->assertInstanceOf('DateTime', $betaTest->getUpdatedAt());
        $this->assertCount(1, $betaTest->getBetaTesters());
    }
}
