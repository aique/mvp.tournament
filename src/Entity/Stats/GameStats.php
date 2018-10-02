<?php

namespace App\Entity\Stats;

use App\Entity\Player;
use App\Entity\Team;
use App\Exceptions\InvalidStatsValuesException;
use App\Services\Score\ScoreCalculator;
use App\Services\Score\ScoreUtilFactory;

class GameStats implements ScoreCalculator {

    /** @var Player */
    private $player;
    /** @var Team */
    private $team;
    /** @var PlayerStats */
    private $playerStats;

    public function __construct(Player $player, Team $team, PlayerStats $playerStats) {
        $this->player = $player;
        $this->team = $team;
        $this->playerStats = $playerStats;
    }

    /**
     * Devuelve los puntos realizados por un jugador para su equipo.
     * @return int
     */
    public function getTeamScore() {
        return $this->playerStats->getTeamScore();
    }

    /**
     * Devuelve los puntos realizados por un jugador para ser elegido MVP.
     * @return float|int
     * @throws InvalidStatsValuesException
     */
    public function getPlayerScore() {
        return $this->playerStats->getPlayerScore();
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

    /**
     * @return PlayerStats
     */
    public function getPlayerStats() {
        return $this->playerStats;
    }
}