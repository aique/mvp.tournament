<?php

namespace App\Entity;

use App\Entity\Stats\PlayerStats;
use App\Services\MatchStatsUtil;

class Match {

    const BASKETBALL_MATCH = 'basketball';
    const HANDBALL_MATCH = 'handball';

    private $matchType;
    /** @var array */
    private $stats;

    public function __construct($matchType) {
        $this->matchType = $matchType;
    }

    /**
     * @return mixed
     */
    public function getMatchType() {
        return $this->matchType;
    }

    /**
     * @param mixed $matchType
     */
    public function setMatchType($matchType) {
        $this->matchType = $matchType;
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
        return MatchStatsUtil::getWinner($this->stats);
    }

    public function getHighestPlayerStat() {
        $highestPlayerScore = 0;
        $highestPlayerStat = null;

        /** @var PlayerStats $currentStat */
        foreach ($this->stats as $currentStat) {
            $currentPlayerScore = $currentStat->getPlayerScore();

            if ($currentPlayerScore > $highestPlayerScore) {
                $highestPlayerScore = $currentPlayerScore;
                $highestPlayerStat = $currentStat;
            }
        }

        return $highestPlayerStat;
    }
}