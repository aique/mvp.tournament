<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Match;
use App\Services\MatchStatsService;

class MatchGenerator {

    /** @var PlayerStatsGenerator */
    private $playerStatsGenerator;

    public function __construct(PlayerStatsGenerator $playerStatsGenerator) {
        $this->playerStatsGenerator = $playerStatsGenerator;
    }

    public function getEmptyStatsMatch() {
        $match = new Match(new MatchStatsService());

        $match->setStats([]);

        return $match;
    }

    public function getOnePlayerStatsMatch() {
        $match = new Match(new MatchStatsService());

        $stats = [
            $this->playerStatsGenerator->getPlayerStats()
        ];

        $match->setStats($stats);

        return $match;
    }
}