<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Stats\GameStats;

class PlayerStatsGenerator {

    private $playerGenerator;
    private $teamGenerator;
    private $gameStatsGenerator;

    public function __construct(PlayerGenerator $playerGenerator, TeamGenerator $teamGenerator, GameStatsGenerator $gameStatsGenerator) {
        $this->playerGenerator = $playerGenerator;
        $this->teamGenerator = $teamGenerator;
        $this->gameStatsGenerator = $gameStatsGenerator;
    }

    public function getPlayerStats($playerIndex, $teamIndex, $gameStatsIndex) {
        assert(is_numeric($playerIndex) && $playerIndex > 0);
        assert(is_numeric($teamIndex) && $teamIndex > 0);
        assert(is_numeric($gameStatsIndex) && $gameStatsIndex > 0);

        $player = $this->playerGenerator->getPlayer($playerIndex);
        $team = $this->teamGenerator->getTeam($teamIndex);
        $gameStats = $this->gameStatsGenerator->getStats($gameStatsIndex);

        return new GameStats($player, $team, $gameStats);
    }
}