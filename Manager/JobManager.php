<?php

namespace Developtech\AgilityBundle\Manager;

use Doctrine\ORM\EntityManager;
use Developtech\AgilityBundle\Utils\Slugger;

abstract class JobManager {
      /** @var EntityManager **/
      protected $em;
      /** @var Slugger **/
      protected $slugger;

      /**
       * @param EntityManager $em
       * @param Slugger $slugger
       */
      public function __construct(EntityManager $em, Slugger $slugger) {
          $this->em = $em;
          $this->slugger = $slugger;
      }
}
