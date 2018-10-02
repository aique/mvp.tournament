<?php

namespace App\Services\Input\Parse;

use App\Entity\Stats\HandballStats;

class HandballStatsFileFileParser extends InputStatsFileParser {

    const NUM_INPUT_FILE_STATS_PER_LINE = 7;

    const POSITION_STATS_VALUE = 4;
    const GOALS_MADE_STATS_VALUE = 5;
    const GOALS_RECEIVED_STATS_VALUE = 6;

    public function __construct() {
        parent::__construct(self::NUM_INPUT_FILE_STATS_PER_LINE);
    }

    public function parseGameStats($inputStatsLine) {
        return parent::parseGameStats($inputStatsLine);
    }

    protected function parsePlayerStats(array $gameStatsArray) {
        $playerStats = new HandballStats(
            $gameStatsArray[self::POSITION_STATS_VALUE],
            $gameStatsArray[self::GOALS_MADE_STATS_VALUE],
            $gameStatsArray[self::GOALS_RECEIVED_STATS_VALUE]
        );

        return $playerStats;
    }
}