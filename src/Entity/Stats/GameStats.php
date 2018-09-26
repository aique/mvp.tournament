<?php

namespace App\Entity\Stats;

use App\Services\Score\ScorablePlayerStats;

interface GameStats {

    /**
     * @return ScorablePlayerStats
     */
    public function getScoreService();
}