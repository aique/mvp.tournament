<?php

namespace App\Services\Score;

use App\Entity\Stats\BasketballStats;
use App\Entity\Stats\HandballStats;
use App\Entity\Stats\ScorablePlayerStats;
use App\Exceptions\WrongDataFileFormatException;

class HandballPlayerScoreUtil implements ScorablePlayerStats {

    const GOAL_MADE_STAT_TYPE = 'goal_made';
    const GOAL_RECEIVED_STAT_TYPE = 'goal_received';

    const GOALKEEPER_POSITION = 'goalkeeper';
    const FIELD_PLAYER_POSITION = 'field_player';

    /** @var HandballStats */
    private $matchStats;

    public function __construct(HandballStats $matchStats) {
        $this->matchStats = $matchStats;
    }

    public function getMatchScore() {
        return $this->matchStats->getGoalMade();
    }

    public function getPlayerScore() {
        return $this->getInitialRatingPoints($this->matchStats->getPosition()) +
            $this->matchStats->getGoalMade() * $this->getGoalMadeRating($this->matchStats->getPosition()) -
            $this->matchStats->getGoalReceived() * $this->getGoalReceivedRating($this->matchStats->getPosition());
    }

    private function getInitialRatingPoints($position) {
        switch ($position) {
            case self::GOALKEEPER_POSITION:
                return 50;
            case self::FIELD_PLAYER_POSITION:
                return 20;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    private function getGoalMadeRating($position) {
        switch ($position) {
            case self::GOALKEEPER_POSITION:
                return 5;
            case self::FIELD_PLAYER_POSITION:
                return 1;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    private function getGoalReceivedRating($position) {
        switch ($position) {
            case self::GOALKEEPER_POSITION:
                return 2;
            case self::FIELD_PLAYER_POSITION:
                return 1;
            default:
                throw new WrongDataFileFormatException();
        }
    }
}