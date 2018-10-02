<?php

namespace App\Services\Input\Parse;

use App\Entity\Stats\BasketballStats;

class BasketballStatsFileFileParser extends InputStatsFileParser {

    const NUM_INPUT_FILE_STATS_PER_LINE = 8;

    const POSITION_STATS_VALUE = 4;
    const POINTS_STATS_VALUE = 5;
    const REBOUNDS_STATS_VALUE = 6;
    const ASSISTS_STATS_VALUE = 7;

    public function __construct() {
        parent::__construct(self::NUM_INPUT_FILE_STATS_PER_LINE);
    }

    public function parseGameStats($inputStatsLine) {
        return parent::parseGameStats($inputStatsLine);
    }

    protected function parsePlayerStats(array $gameStatsArray) {
        $playerStats = new BasketballStats(
            $gameStatsArray[self::POSITION_STATS_VALUE],
            $gameStatsArray[self::POINTS_STATS_VALUE],
            $gameStatsArray[self::REBOUNDS_STATS_VALUE],
            $gameStatsArray[self::ASSISTS_STATS_VALUE]
        );

        return $playerStats;
    }


}