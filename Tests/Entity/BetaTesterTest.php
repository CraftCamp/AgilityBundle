<?php

namespace Developtech\AgilityBundle\Tests\Entity;

use Developtech\AgilityBundle\Entity\BetaTester;
use Developtech\AgilityBundle\Tests\Mock\User;

class BetaTesterTest extends \PHPUnit_Framework_TestCase {
    public function testEntity() {
        $betaTester =
            (new BetaTester)
            ->setId(1)
            ->setAccount(new User())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;
        $this->assertEquals(1, $betaTester->getId());
        $this->assertInstanceOf(User::class, $betaTester->getAccount());
        $this->assertInstanceOf('DateTime', $betaTester->getCreatedAt());
        $this->assertInstanceOf('DateTime', $betaTester->getUpdatedAt());
    }
}
