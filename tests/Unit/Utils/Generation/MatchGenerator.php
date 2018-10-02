<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Match;
use App\Services\MatchWinnerFinder;

class MatchGenerator {

    /** @var PlayerStatsGenerator */
    private $playerStatsGenerator;

    public function __construct(PlayerStatsGenerator $playerStatsGenerator) {
        $this->playerStatsGenerator = $playerStatsGenerator;
    }

    public function getNoStatsMatch() {
        $match = new Match(new MatchWinnerFinder());

        return $match;
    }

    public function getEmptyStatsMatch() {
        $match = new Match(new MatchWinnerFinder());

        $match->setGameStats([]);

        return $match;
    }

    public function getOnePlayerStatsMatch(array $stats) {
        $match = new Match(new MatchWinnerFinder());

        $stats = [
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_1,
                TeamGenerator::TEAM_1,
                $stats[0]
            )
        ];

        $match->setGameStats($stats);

        return $match;
    }

    public function getTwoPlayerStatsMatch(array $stats) {
        $match = new Match(new MatchWinnerFinder());

        $stats = [
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_1,
                TeamGenerator::TEAM_1,
                $stats[0]
            ),
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_2,
                TeamGenerator::TEAM_2,
                $stats[1]
            ),
        ];

        $match->setGameStats($stats);

        return $match;
    }

    public function getFourPlayerStatsMatch(array $stats) {
        $match = new Match(new MatchWinnerFinder());

        $stats = [
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_1,
                TeamGenerator::TEAM_1,
                $stats[0]
            ),
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_2,
                TeamGenerator::TEAM_1,
                $stats[1]
            ),
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_3,
                TeamGenerator::TEAM_2,
                $stats[2]
            ),
            $this->playerStatsGenerator->getPlayerStats(
                PlayerGenerator::PLAYER_4,
                TeamGenerator::TEAM_2,
                $stats[3]
            ),
        ];

        $match->setGameStats($stats);

        return $match;
    }
}