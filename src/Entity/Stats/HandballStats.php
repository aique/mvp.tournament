<?php

namespace App\Entity\Stats;

class HandballStats {

    private $position;
    private $goalMade;
    private $goalReceived;

    public function __construct($position, $goalMade, $goalReceived) {
        $this->position = $position;
        $this->goalMade = $goalMade;
        $this->goalReceived = $goalReceived;
    }

    /**
     * @return mixed
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getGoalMade() {
        return $this->goalMade;
    }

    /**
     * @return mixed
     */
    public function getGoalReceived() {
        return $this->goalReceived;
    }
}