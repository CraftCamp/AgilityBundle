<?php

namespace Developtech\AgilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Feedback
 *
 * @ORM\Entity(repositoryClass="Developtech\AgilityBundle\Repository\FeedbackRepository")
 * @ORM\Table(name="developtech_agility__feedbacks")
 * @ORM\HasLifecycleCallbacks()
 */
class Feedback extends Job {
      /** @var UserInterface */
      protected $author;

      const STATUS_OPEN = 0;
      const STATUS_TO_DO = 1;
      const STATUS_IN_PROGRESS = 2;
      const STATUS_TO_VALIDATE = 3;
      const STATUS_DONE = 4;
      const STATUS_CLOSED = 5;

      /**
       * Set author
       *
       * @param UserInterface $author
       *
       * @return FeedbackModel
       */
      public function setAuthor(UserInterface $author)
      {
          $this->author = $author;

          return $this;
      }

      /**
       * Get author
       *
       * @return UserInterface
       */
      public function getAuthor()
      {
          return $this->author;
      }

      /**
       * @return string
       */
      public function getType() {
          return self::TYPE_FEEDBACK;
      }
}
