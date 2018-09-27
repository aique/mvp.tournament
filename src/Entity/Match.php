<?php

namespace App\Entity;

use App\Entity\Stats\PlayerStats;
use App\Services\MatchStatsService;

class Match {

    /** @var array */
    private $stats;
    /** @var MatchStatsService */
    private $matchStatsService;

    public function __construct(MatchStatsService $matchStatsService) {
        $this->matchStatsService = $matchStatsService;
        $this->stats = [];
    }

    /**
     * @return array
     */
    public function getStats() {
        return $this->stats;
    }

    /**
     * @param array $stats
     */
    public function setStats($stats) {
        $this->stats = $stats;
    }

    public function getWinner() {
        return $this->matchStatsService->getWinner($this->stats);
    }

    public function getHighestPlayerStat() {
        return $this->matchStatsService->getHighestPlayerStat($this->stats);
    }
}