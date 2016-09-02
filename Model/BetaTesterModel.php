<?php

namespace Developtech\AgilityBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class BetaTesterModel {
    /** @var UserInterface **/
    protected $account;
    /** @var \DateTime **/
    protected $createdAt;
    /** @var \DateTime **/
    protected $updatedAt;

    /**
     * @param UserInterface $account
     * @return BetaTesterModel
     */
    public function setAccount(UserInterface $account) {
        $this->account = $account;

        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getAccount() {
        return $this->account;
    }

    /**
     * @param \DateTime $createdAt
     * @return BetaTesterModel
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return BetaTesterModel
     */
    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
}
