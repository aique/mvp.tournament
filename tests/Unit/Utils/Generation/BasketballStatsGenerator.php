<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Stats\BasketballStats;
use App\Services\Score\BasketballScoreCalculator;

class BasketballStatsGenerator extends GameStatsGenerator {

    const STATS_RANK_1_SCORE = 60;
    const STATS_RANK_2_SCORE = 42;
    const STATS_RANK_3_SCORE = 32;
    const STATS_RANK_4_SCORE = 18;

    const POSITION_STATS_1 = BasketballStats::CENTER_POSITION;
    const POINTS_STATS_1 = 18;
    const REBOUNDS_STATS_1 = 12;
    const ASSISTS_STATS_1 = 4;

    const POSITION_STATS_2 = BasketballStats::GUARD_POSITION;
    const POINTS_STATS_2 = 14;
    const REBOUNDS_STATS_2 = 2;
    const ASSISTS_STATS_2 = 8;

    const POSITION_STATS_3 = BasketballStats::FORWARD_POSITION;
    const POINTS_STATS_3 = 10;
    const REBOUNDS_STATS_3 = 4;
    const ASSISTS_STATS_3 = 2;

    const POSITION_STATS_4 = BasketballStats::CENTER_POSITION;
    const POINTS_STATS_4 = 4;
    const REBOUNDS_STATS_4 = 4;
    const ASSISTS_STATS_4 = 2;

    public function __construct() {
        $this->stats = [
            new BasketballStats(self::POSITION_STATS_1, self::POINTS_STATS_1, self::REBOUNDS_STATS_1, self::ASSISTS_STATS_1),
            new BasketballStats(self::POSITION_STATS_2, self::POINTS_STATS_2, self::REBOUNDS_STATS_2, self::ASSISTS_STATS_2),
            new BasketballStats(self::POSITION_STATS_3, self::POINTS_STATS_3, self::REBOUNDS_STATS_3, self::ASSISTS_STATS_3),
            new BasketballStats(self::POSITION_STATS_4, self::POINTS_STATS_4, self::REBOUNDS_STATS_4, self::ASSISTS_STATS_4),
        ];
    }
}