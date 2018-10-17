<?php

namespace App\Entity\Stats;

use App\Exceptions\InvalidStatsValuesException;
use App\Services\Score\ScoreCalculator;

abstract class PlayerStats implements ScoreCalculator {

    /**
     * GameStats constructor.
     * @throws InvalidStatsValuesException
     */
    public function __construct() {
        if (!$this->validStats()) {
            throw new InvalidStatsValuesException();
        }
    }

    protected abstract function validStats();

    public function getTeamScore() {
        return $this->getScoreCalculator()->getTeamScore();
    }

    /**
     * @throws InvalidStatsValuesException
     */
    public function getPlayerScore() {
        return $this->getScoreCalculator()->getPlayerScore();
    }

    public abstract function setPosition($position);

    /**
     * @return ScoreCalculator
     */
    protected abstract function getScoreCalculator();

    protected function validPositiveNumericValue($statValue) {
        return is_numeric($statValue) && $statValue >= 0;
    }
}