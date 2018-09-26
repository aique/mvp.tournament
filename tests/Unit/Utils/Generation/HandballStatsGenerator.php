<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Stats\HandballStats;
use App\Services\Score\HandballPlayerScoreService;

class HandballStatsGenerator implements GameStatsGenerator {

    const POSITION = HandballPlayerScoreService::FIELD_PLAYER_POSITION;
    const GOAL_MADE = 2;
    const GOAL_RECEIVED = 1;

    public function getStats() {
        return new HandballStats(
            self::POSITION,
            self::GOAL_MADE,
            self::GOAL_RECEIVED
        );
    }
}