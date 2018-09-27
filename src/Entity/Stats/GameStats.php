<?php

namespace App\Entity\Stats;

use App\Services\Score\ScoreCalculator;

abstract class GameStats {

    /**
     * @return ScoreCalculator
     */
    public abstract function getScoreCalculator();

    protected function validPositiveNumericValue($statValue) {
        return is_numeric($statValue) && $statValue >= 0;
    }
}