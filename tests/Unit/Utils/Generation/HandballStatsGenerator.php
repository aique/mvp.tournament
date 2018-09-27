<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Stats\HandballStats;
use App\Services\Score\HandballScoreCalculator;

class HandballStatsGenerator extends GameStatsGenerator {

    const STATS_RANK_1_SCORE = 58;
    const STATS_RANK_2_SCORE = 48;
    const STATS_RANK_3_SCORE = 21;
    const STATS_RANK_4_SCORE = 18;

    const POSITION_STATS_1 = HandballStats::GOALKEEPER_POSITION;
    const GOAL_MADE_STATS_1 = 2;
    const GOAL_RECEIVED_STATS_1 = 1;

    const POSITION_STATS_2 = HandballStats::GOALKEEPER_POSITION;
    const GOAL_MADE_STATS_2 = 0;
    const GOAL_RECEIVED_STATS_2 = 1;

    const POSITION_STATS_3 = HandballStats::FIELD_PLAYER_POSITION;
    const GOAL_MADE_STATS_3 = 2;
    const GOAL_RECEIVED_STATS_3 = 1;

    const POSITION_STATS_4 = HandballStats::FIELD_PLAYER_POSITION;
    const GOAL_MADE_STATS_4 = 1;
    const GOAL_RECEIVED_STATS_4 = 3;

    public function __construct() {
        $this->stats = [
            new HandballStats(self::POSITION_STATS_1, self::GOAL_MADE_STATS_1, self::GOAL_RECEIVED_STATS_1),
            new HandballStats(self::POSITION_STATS_2, self::GOAL_MADE_STATS_2, self::GOAL_RECEIVED_STATS_2),
            new HandballStats(self::POSITION_STATS_3, self::GOAL_MADE_STATS_3, self::GOAL_RECEIVED_STATS_3),
            new HandballStats(self::POSITION_STATS_4, self::GOAL_MADE_STATS_4, self::GOAL_RECEIVED_STATS_4),
        ];
    }
}