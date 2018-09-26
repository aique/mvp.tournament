<?php

namespace App\Services\Score;

use App\Entity\Stats\BasketballStats;
use App\Entity\Stats\ScorablePlayerStats;
use App\Exceptions\WrongDataFileFormatException;

class BasketballPlayerScoreUtil implements ScorablePlayerStats {

    const SCORED_POINT_STAT_TYPE = 'scored_point';
    const REBOUND_STAT_TYPE = 'rebound';
    const ASSIST_STAT_TYPE = 'assist';

    const GUARD_POSITION = 'guard';
    const FORWARD_POSITION = 'forward';
    const CENTER_POSITION = 'center';

    /** @var BasketballStats */
    private $matchStats;

    public function __construct(BasketballStats $matchStats) {
        $this->matchStats = $matchStats;
    }

    public function getMatchScore() {
        return $this->matchStats->getPoints();
    }

    public function getPlayerScore() {
        return $this->matchStats->getPoints() * $this->getScoredPointRating($this->matchStats->getPosition()) +
            $this->matchStats->getRebounds() * $this->getReboundRating($this->matchStats->getPosition()) +
            $this->matchStats->getAssists() * $this->getAssistRating($this->matchStats->getPosition());
    }

    private function getScoredPointRating($position) {
        switch ($position) {
            case self::GUARD_POSITION:
            case self::FORWARD_POSITION:
            case self::CENTER_POSITION:
                return 2;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    private function getReboundRating($position) {
        switch ($position) {
            case self::GUARD_POSITION:
                return 3;
            case self::FORWARD_POSITION:
                return 2;
            case self::CENTER_POSITION:
                return 1;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    private function getAssistRating($position) {
        switch ($position) {
            case self::GUARD_POSITION:
                return 1;
            case self::FORWARD_POSITION:
                return 2;
            case self::CENTER_POSITION:
                return 3;
            default:
                throw new WrongDataFileFormatException();
        }
    }
}