<?php

namespace Developtech\AgilityBundle\Tests\Mock;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {
    /** @var string **/
    protected $username;
    /** @var string **/
    protected $password;
    /** @var string **/
    protected $salt;
    /** @var array **/
    protected $roles;

    /**
     * @param string $username
     * @param string $password
     * @param string $salt
     * @param array $roles
     */
    public function __construct($username = '', $password = '', $salt = '', $roles = []) {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @return array
     */
    public function getRoles() {
        return $this->roles;
    }

    /**
     * @return boolean
     */
    public function eraseCredentials() {
        return true;
    }
}
