<?php

namespace App\Entity\Stats;

use App\Exceptions\WrongDataFileFormatException;
use App\Services\Score\BasketballScoreCalculator;

class BasketballStats extends GameStats {

    const GUARD_POSITION = 'guard';
    const FORWARD_POSITION = 'forward';
    const CENTER_POSITION = 'center';

    private $position;
    private $points;
    private $rebounds;
    private $assists;

    /**
     * BasketballStats constructor.
     * @param $position
     * @param $points
     * @param $rebounds
     * @param $assists
     * @throws WrongDataFileFormatException
     */
    public function __construct($position, $points, $rebounds, $assists) {
        $this->position = $position;
        $this->points = $points;
        $this->rebounds = $rebounds;
        $this->assists = $assists;

        if (!$this->validStats()) {
            throw new WrongDataFileFormatException();
        }
    }

    private function validStats() {
        return $this->validPosition() &&
            $this->validPositiveNumericValue($this->points) &&
            $this->validPositiveNumericValue($this->rebounds) &&
            $this->validPositiveNumericValue($this->assists);
    }

    private function validPosition() {
        return $this->position == self::GUARD_POSITION ||
            $this->position == self::FORWARD_POSITION ||
            $this->position == self::CENTER_POSITION;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getRebounds() {
        return $this->rebounds;
    }

    public function getAssists() {
        return $this->assists;
    }

    public function getScoreCalculator() {
        return new BasketballScoreCalculator($this);
    }
}