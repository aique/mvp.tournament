<?php

namespace App\Tests\Unit\Entity\Stats;

use App\Entity\Player;
use App\Entity\Stats\PlayerStats;
use App\Entity\Team;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\GameStatsGenerator;
use App\Tests\Unit\Utils\Generation\HandballStatsGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use PHPUnit\Framework\TestCase;

class PlayerStatsTest extends TestCase {

    /** @var PlayerStats */
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

        $player = $this->playerGenerator->getPlayer();
        $team = $this->teamGenerator->getTeam();
        $gameStats = $gameStatsGenerator->getStats();

        return new PlayerStats($player, $team, $gameStats);
    }

    public function testConstructorPlayer() {
        $unknownPlayer = new Player("Manuel Fuentes", "mfuentes");

        $this->assertEquals($this->playerStats->getPlayer(), $this->playerGenerator->getPlayer());
        $this->assertNotEquals($this->playerStats->getPlayer(), $unknownPlayer);
    }

    public function testConstructorTeam() {
        $unknownTeam = new Team("Ranas Saltarinas");

        $this->assertEquals($this->playerStats->getTeam(), $this->teamGenerator->getTeam());
        $this->assertNotEquals($this->playerStats->getTeam(), $unknownTeam);
    }

    public function testConstructorStats() {
        $this->playerStatsAssertions();
    }

    private function playerStatsAssertions() {
        $scoreService = $this->gameStatsGenerator->getStats()->getScoreService();
        $playerScore = $scoreService->getPlayerScore();
        $matchScore = $scoreService->getMatchScore();

        $this->assertEquals($this->playerStats->getPlayerScore(), $playerScore);
        $this->assertEquals($this->playerStats->getMatchScore(), $matchScore);
    }

    public function testPlayerSetter() {
        $unknownPlayer = new Player("Manuel Fuentes", "mfuentes");

        $this->assertEquals($this->playerStats->getPlayer(), $this->playerGenerator->getPlayer());
        $this->playerStats->setPlayer($unknownPlayer);
        $this->assertEquals($this->playerStats->getPlayer(), $unknownPlayer);
    }

    public function testTeamSetter() {
        $unknownTeam = new Team("Ranas Saltarinas");

        $this->assertEquals($this->playerStats->getTeam(), $this->teamGenerator->getTeam());
        $this->playerStats->setTeam($unknownTeam);
        $this->assertEquals($this->playerStats->getTeam(), $unknownTeam);
    }

    public function testHandballStats() {
        $this->playerStats = $this->createPlayerStats(new HandballStatsGenerator());
        $this->playerStatsAssertions();
    }
}