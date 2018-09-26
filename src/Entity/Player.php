<?php

namespace App\Entity;

class Player {

    private $name;
    private $nickname;
    
    public function __construct($name, $nickname) {
        $this->name = $name;
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNickname() {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }
}