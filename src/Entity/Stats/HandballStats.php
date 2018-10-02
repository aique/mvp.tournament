<?php

namespace App\Entity\Stats;

use App\Services\Score\HandballScoreCalculator;

class HandballStats extends PlayerStats {

    const GOALKEEPER_POSITION = 'G';
    const FIELD_PLAYER_POSITION = 'F';

    private $position;
    private $goalsMade;
    private $goalsReceived;

    public function __construct($position, $goalsMade, $goalsReceived) {
        $this->position = $position;
        $this->goalsMade = $goalsMade;
        $this->goalsReceived = $goalsReceived;

        parent::__construct();
    }

    protected function validStats() {
        return $this->validPosition() &&
            $this->validPositiveNumericValue($this->goalsMade) &&
            $this->validPositiveNumericValue($this->goalsReceived);
    }

    private function validPosition() {
        return $this->position == self::GOALKEEPER_POSITION ||
            $this->position == self::FIELD_PLAYER_POSITION;
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
    public function getGoalsMade() {
        return $this->goalsMade;
    }

    /**
     * @return mixed
     */
    public function getGoalsReceived() {
        return $this->goalsReceived;
    }

    protected function getScoreCalculator() {
        return new HandballScoreCalculator($this);
    }
}