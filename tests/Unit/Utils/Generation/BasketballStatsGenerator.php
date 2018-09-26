<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Stats\BasketballStats;
use App\Services\Score\BasketballPlayerScoreService;

class BasketballStatsGenerator implements GameStatsGenerator {

    const POSITION = BasketballPlayerScoreService::GUARD_POSITION;
    const POINTS = 14;
    const REBOUNDS = 2;
    const ASSISTS = 8;

    public function getStats() {
        return new BasketballStats(
            self::POSITION,
            self::POINTS,
            self::REBOUNDS,
            self::ASSISTS
        );
    }


}