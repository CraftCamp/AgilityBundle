<?php

namespace Developtech\AgilityBundle\Tests\Model;

use Developtech\AgilityBundle\Tests\Mock\Project;

class ProjectModelTest extends \PHPUnit_Framework_TestCase {
    public function testModel() {
        $entity =
            (new Project())
            ->setId(1)
            ->setName('Great project')
            ->setSlug('great-project')
            ->setCreatedAt(new \DateTime())
            ->setProductOwner((new \StdClass()))
            ->setBetaTestStatus('open')
            ->setNbBetaTesters(12)
        ;
        $this->assertEquals(1, $entity->getId());
        $this->assertEquals('Great project', $entity->getName());
        $this->assertEquals('great-project', $entity->getSlug());
        $this->assertInstanceOf('DateTime', $entity->getCreatedAt());
        $this->assertInstanceOf('StdClass', $entity->getProductOwner());
        $this->assertEquals('open', $entity->getBetaTestStatus());
        $this->assertEquals(12, $entity->getNbBetaTesters());
    }
}
