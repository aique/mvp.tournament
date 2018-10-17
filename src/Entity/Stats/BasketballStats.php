<?php

namespace App\Entity\Stats;

use App\Services\Score\BasketballScoreCalculator;

class BasketballStats extends PlayerStats {

    const GUARD_POSITION = 'G';
    const FORWARD_POSITION = 'F';
    const CENTER_POSITION = 'C';

    private $position;
    private $points;
    private $rebounds;
    private $assists;

    public function __construct($position, $points, $rebounds, $assists) {
        $this->position = $position;
        $this->points = $points;
        $this->rebounds = $rebounds;
        $this->assists = $assists;

        parent::__construct();
    }

    protected function validStats() {
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

    public function setPosition($position) {
        $this->position = $position;
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

    protected function getScoreCalculator() {
        return new BasketballScoreCalculator($this);
    }
}