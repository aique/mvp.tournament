<?php

namespace App\Services\Score;

use App\Entity\Stats\BasketballStats;
use App\Exceptions\WrongDataFileFormatException;

class BasketballScoreCalculator implements ScoreCalculator {

    const SCORED_POINT_STAT_TYPE = 'scored_point';
    const REBOUND_STAT_TYPE = 'rebound';
    const ASSIST_STAT_TYPE = 'assist';

    /** @var BasketballStats */
    private $matchStats;

    public function __construct(BasketballStats $matchStats) {
        $this->matchStats = $matchStats;
    }

    public function getMatchScore() {
        return $this->matchStats->getPoints();
    }

    /**
     * @return float|int
     * @throws WrongDataFileFormatException
     */
    public function getPlayerScore() {
        return $this->matchStats->getPoints() * $this->getScoredPointRating($this->matchStats->getPosition()) +
            $this->matchStats->getRebounds() * $this->getReboundRating($this->matchStats->getPosition()) +
            $this->matchStats->getAssists() * $this->getAssistRating($this->matchStats->getPosition());
    }

    /**
     * @param $position
     * @return int
     * @throws WrongDataFileFormatException
     */
    private function getScoredPointRating($position) {
        switch ($position) {
            case BasketballStats::GUARD_POSITION:
            case BasketballStats::FORWARD_POSITION:
            case BasketballStats::CENTER_POSITION:
                return 2;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    /**
     * @param $position
     * @return int
     * @throws WrongDataFileFormatException
     */
    private function getReboundRating($position) {
        switch ($position) {
            case BasketballStats::GUARD_POSITION:
                return 3;
            case BasketballStats::FORWARD_POSITION:
                return 2;
            case BasketballStats::CENTER_POSITION:
                return 1;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    /**
     * @param $position
     * @return int
     * @throws WrongDataFileFormatException
     */
    private function getAssistRating($position) {
        switch ($position) {
            case BasketballStats::GUARD_POSITION:
                return 1;
            case BasketballStats::FORWARD_POSITION:
                return 2;
            case BasketballStats::CENTER_POSITION:
                return 3;
            default:
                throw new WrongDataFileFormatException();
        }
    }
}