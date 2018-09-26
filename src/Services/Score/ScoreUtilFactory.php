<?php

namespace App\Services\Score;

use App\Entity\Match;
use App\Exceptions\WrongDataFileFormatException;

class ScoreUtilFactory {

    /**
     * @param $matchType
     * @param $gameStats
     * @return BasketballPlayerScoreUtil|HandballPlayerScoreUtil
     * @throws WrongDataFileFormatException
     */
    public static function getScoreUtil($matchType, $gameStats) {
        switch ($matchType) {
            case Match::BASKETBALL_MATCH:
                return new BasketballPlayerScoreUtil($gameStats);
            case Match::HANDBALL_MATCH:
                return new HandballPlayerScoreUtil($gameStats);
            default: throw new WrongDataFileFormatException();
        }
    }
}

