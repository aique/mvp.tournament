<?php

namespace App\Entity\Stats;

use App\Exceptions\WrongDataFileFormatException;
use App\Services\Score\HandballScoreCalculator;

class HandballStats extends GameStats {

    const GOALKEEPER_POSITION = 'goalkeeper';
    const FIELD_PLAYER_POSITION = 'field_player';

    private $position;
    private $goalMade;
    private $goalReceived;

    /**
     * HandballStats constructor.
     * @param $position
     * @param $goalMade
     * @param $goalReceived
     * @throws WrongDataFileFormatException
     */
    public function __construct($position, $goalMade, $goalReceived) {
        $this->position = $position;
        $this->goalMade = $goalMade;
        $this->goalReceived = $goalReceived;

        if (!$this->validStats()) {
            throw new WrongDataFileFormatException();
        }
    }

    private function validStats() {
        return $this->validPosition() &&
            $this->validPositiveNumericValue($this->goalMade) &&
            $this->validPositiveNumericValue($this->goalReceived);
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
    public function getGoalMade() {
        return $this->goalMade;
    }

    /**
     * @return mixed
     */
    public function getGoalReceived() {
        return $this->goalReceived;
    }

    public function getScoreCalculator() {
        return new HandballScoreCalculator($this);
    }
}