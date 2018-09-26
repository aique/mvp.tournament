<?php

namespace App\Entity\Stats;

use App\Entity\Match;
use App\Services\Score\ScoreUtilFactory;

class PlayerStats implements ScorablePlayerStats {

    /** @var \App\Entity\Team */
    private $team;
    /** @var \App\Entity\Player */
    private $player;
    /** @var \App\Entity\Match */
    private $match;
    /** @var ScorablePlayerStats */
    private $gameStats;

    public function __construct($player, $team, $match, $gameStats) {
        $this->player = $player;
        $this->team = $team;
        $this->match = $match;
        $this->gameStats = $gameStats;
    }

    /**
     * Devuelve los puntos realizados por un jugador para su equipo.
     * @return int
     */
    public function getMatchScore() {
        return ScoreUtilFactory::getScoreUtil($this->match->getMatchType(), $this->gameStats)->getMatchScore();
    }

    /**
     * Devuelve los puntos realizados por un jugador para ser elegido MVP.
     * @return int
     */
    public function getPlayerScore() {
        return ScoreUtilFactory::getScoreUtil($this->match->getMatchType(), $this->gameStats)->getPlayerScore();
    }

    /**
     * @return \App\Entity\Team
     */
    public function getTeam() {
        return $this->team;
    }

    /**
     * @param \App\Entity\Team $team
     */
    public function setTeam($team) {
        $this->team = $team;
    }

    /**
     * @return \App\Entity\Player
     */
    public function getPlayer() {
        return $this->player;
    }

    /**
     * @param \App\Entity\Player $player
     */
    public function setPlayer($player) {
        $this->player = $player;
    }

    /**
     * @return Match
     */
    public function getMatch() {
        return $this->match;
    }

    /**
     * @param Match $match
     */
    public function setMatch($match) {
        $this->match = $match;
    }
}