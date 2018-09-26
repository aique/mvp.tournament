<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Stats\PlayerStats;

class PlayerStatsGenerator {

    private $playerGenerator;
    private $teamGenerator;
    private $gameStatsGenerator;

    public function __construct(PlayerGenerator $playerGenerator, TeamGenerator $teamGenerator, GameStatsGenerator $gameStatsGenerator) {
        $this->playerGenerator = $playerGenerator;
        $this->teamGenerator = $teamGenerator;
        $this->gameStatsGenerator = $gameStatsGenerator;
    }

    public function getPlayerStats() {
        $player = $this->playerGenerator->getPlayer();
        $team = $this->teamGenerator->getTeam();
        $gameStats = $this->gameStatsGenerator->getStats();

        return new PlayerStats($player, $team, $gameStats);
    }
}