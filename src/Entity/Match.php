<?php

namespace App\Entity;

use App\Entity\Stats\GameStats;
use App\Services\MatchMvpFinder;
use App\Services\MatchWinnerFinder;

class Match {

    /** @var array */
    private $gameStats;
    /** @var MatchWinnerFinder */
    private $matchWinnerFinder;

    public function __construct(MatchWinnerFinder $matchWinnerFinder) {
        $this->matchWinnerFinder = $matchWinnerFinder;
        $this->gameStats = [];
    }

    /**
     * @return array
     */
    public function getGameStats() {
        return $this->gameStats;
    }

    /**
     * @param array $gameStats
     */
    public function setGameStats($gameStats) {
        $this->gameStats = $gameStats;
    }

    public function addGameStats(GameStats $gameStats) {
        $this->gameStats[] = $gameStats;
    }

    public function getWinner() {
        return $this->matchWinnerFinder->getWinner($this->gameStats);
    }
}