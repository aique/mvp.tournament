<?php

namespace App\Entity\Stats;

use App\Entity\Player;
use App\Entity\Team;
use App\Exceptions\WrongDataFileFormatException;
use App\Services\Score\ScorablePlayerStats;
use App\Services\Score\ScoreUtilFactory;

class PlayerStats implements ScorablePlayerStats {

    /** @var Team */
    private $team;
    /** @var Player */
    private $player;
    /** @var GameStats */
    private $gameStats;

    public function __construct($player, $team, $gameStats) {
        $this->player = $player;
        $this->team = $team;
        $this->gameStats = $gameStats;
    }

    /**
     * Devuelve los puntos realizados por un jugador para su equipo.
     * @return int
     */
    public function getMatchScore() {
        return $this->gameStats->getScoreService()->getMatchScore();
    }

    /**
     * Devuelve los puntos realizados por un jugador para ser elegido MVP.
     * @return float|int
     * @throws WrongDataFileFormatException
     */
    public function getPlayerScore() {
        return $this->gameStats->getScoreService()->getPlayerScore();
    }

    /**
     * @return Team
     */
    public function getTeam() {
        return $this->team;
    }

    /**
     * @param Team $team
     */
    public function setTeam($team) {
        $this->team = $team;
    }

    /**
     * @return Player
     */
    public function getPlayer() {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer($player) {
        $this->player = $player;
    }
}