<?php

namespace App\Services\Score;

use App\Entity\Stats\HandballStats;
use App\Exceptions\WrongDataFileFormatException;

class HandballScoreCalculator implements ScoreCalculator {

    const GOAL_MADE_STAT_TYPE = 'goal_made';
    const GOAL_RECEIVED_STAT_TYPE = 'goal_received';

    /** @var HandballStats */
    private $matchStats;

    public function __construct(HandballStats $matchStats) {
        $this->matchStats = $matchStats;
    }

    public function getTeamScore() {
        return $this->matchStats->getGoalsMade();
    }

    /**
     * @return float|int
     * @throws WrongDataFileFormatException
     */
    public function getPlayerScore() {
        return $this->getInitialRatingPoints($this->matchStats->getPosition()) +
            $this->matchStats->getGoalsMade() * $this->getGoalMadeRating($this->matchStats->getPosition()) -
            $this->matchStats->getGoalsReceived() * $this->getGoalReceivedRating($this->matchStats->getPosition());
    }

    /**
     * @param $position
     * @return int
     * @throws WrongDataFileFormatException
     */
    private function getInitialRatingPoints($position) {
        switch ($position) {
            case HandballStats::GOALKEEPER_POSITION:
                return 50;
            case HandballStats::FIELD_PLAYER_POSITION:
                return 20;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    /**
     * @param $position
     * @return int
     * @throws WrongDataFileFormatException
     */
    private function getGoalMadeRating($position) {
        switch ($position) {
            case HandballStats::GOALKEEPER_POSITION:
                return 5;
            case HandballStats::FIELD_PLAYER_POSITION:
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
    private function getGoalReceivedRating($position) {
        switch ($position) {
            case HandballStats::GOALKEEPER_POSITION:
                return 2;
            case HandballStats::FIELD_PLAYER_POSITION:
                return 1;
            default:
                throw new WrongDataFileFormatException();
        }
    }
}