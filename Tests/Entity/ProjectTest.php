<?php

namespace DevelopTech\AgilityBundle\Tests\Entity;

use DevelopTech\AgilityBundle\Entity\Project;

class ProjectTest extends \PHPUnit_Framework_TestCase {
    public function testEntity() {
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
