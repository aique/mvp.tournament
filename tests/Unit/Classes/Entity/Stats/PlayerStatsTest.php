<?php

namespace App\Tests\Unit\Classes\Entity\Stats;

use App\Entity\Stats\GameStats;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\GameStatsGenerator;
use App\Tests\Unit\Utils\Generation\HandballStatsGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use PHPUnit\Framework\TestCase;

class PlayerStatsTest extends TestCase {

    /** @var GameStats */
    private $playerStats;
    /** @var GameStatsGenerator */
    private $gameStatsGenerator;
    /** @var PlayerGenerator */
    private $playerGenerator;
    /** @var TeamGenerator */
    private $teamGenerator;

    public function setUp() {
        $this->playerStats = $this->createPlayerStats(new BasketballStatsGenerator());
    }

    private function createPlayerStats(GameStatsGenerator $gameStatsGenerator) {
        $this->gameStatsGenerator = $gameStatsGenerator;
        $this->playerGenerator = new PlayerGenerator();
        $this->teamGenerator = new TeamGenerator();

        $player = $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_1);
        $team = $this->teamGenerator->getTeam(TeamGenerator::TEAM_1);
        $gameStats = $gameStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_2);

        return new GameStats($player, $team, $gameStats);
    }

    public function testConstructorPlayer() {
        $alternativePlayer = $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_2);

        $this->assertEquals($this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_1), $this->playerStats->getPlayer());
        $this->assertNotEquals($alternativePlayer, $this->playerStats->getPlayer());
    }

    public function testConstructorTeam() {
        $alternativeTeam = $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_2);

        $this->assertEquals($this->teamGenerator->getTeam(TeamGenerator::TEAM_1), $this->playerStats->getTeam());
        $this->assertNotEquals($alternativeTeam, $this->playerStats->getTeam());
    }

    public function testConstructorStats() {
        $this->playerStatsAssertions();
    }

    private function playerStatsAssertions() {
        $gameStats = $this->gameStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_2);
        $playerScore = $gameStats->getPlayerScore();
        $matchScore = $gameStats->getTeamScore();

        $this->assertEquals($playerScore, $this->playerStats->getPlayerScore());
        $this->assertEquals($matchScore, $this->playerStats->getTeamScore());
    }

    public function testPlayerSetter() {
        $alternativePlayer = $this->playerGenerator->getPlayer(2);

        $this->assertEquals($this->playerGenerator->getPlayer(1), $this->playerStats->getPlayer());
        $this->playerStats->setPlayer($alternativePlayer);
        $this->assertEquals($alternativePlayer, $this->playerStats->getPlayer());
    }

    public function testTeamSetter() {
        $alternativeTeam = $this->teamGenerator->getTeam(TeamGenerator::TEAM_2);

        $this->assertEquals($this->teamGenerator->getTeam(TeamGenerator::TEAM_1), $this->playerStats->getTeam());
        $this->playerStats->setTeam($alternativeTeam);
        $this->assertEquals($alternativeTeam, $this->playerStats->getTeam());
    }

    public function testHandballStats() {
        $this->playerStats = $this->createPlayerStats(new HandballStatsGenerator());
        $this->playerStatsAssertions();
    }
}