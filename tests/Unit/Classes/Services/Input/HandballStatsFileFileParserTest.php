<?php

namespace App\Tests\Unit\Classes\Services\Input;

use App\Entity\Player;
use App\Entity\Stats\GameStats;
use App\Entity\Stats\HandballStats;
use App\Entity\Team;
use App\Services\Input\Parse\HandballStatsFileFileParser;

class HandballStatsFileFileParserTest extends GameStatsFileParserTest {

    private $inputStatsLine;
    /** @var HandballStats */
    private $handballStats;

    public function setUp() {
        $this->inputStatsLine = 'player​ ​ 1;nick1;4;Team​ ​ A;G;0;20';
        $this->player = new Player('player​ ​ 1', 'nick1');
        $this->team = new Team('Team​ ​ A');
        $this->handballStats = new HandballStats('G', 0, 20);
        $this->gameStatsFileParser = new HandballStatsFileFileParser();
    }

    public function testObtainGameStat() {
        $gameStat = $this->gameStatsFileParser->parseGameStats($this->inputStatsLine);

        $this->assertNotNull($gameStat);
        $this->assertPlayer($gameStat);
        $this->assertTeam($gameStat);
        $this->assertStats($gameStat);
    }

    public function testInvalidPosition() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;Z;0;20');
    }

    public function testInvalidNumericPosition() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;5;0;20');
    }

    public function testInvalidEmptyPosition() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;0;20');
    }

    public function testInvalidGoalsMade() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;-1;20');
    }

    public function testInvalidNoNumericGoalsMade() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;A;20');
    }

    public function testInvalidEmptyGoalsMade() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;G;20');
    }

    public function testInvalidGoalsReceived() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;0;-20');
    }

    public function testInvalidNoNumericGoalsReceived() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;0;A');
    }

    public function testInvalidEmptyGoalsReceived() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;G;0');
    }

    private function assertStats(GameStats $gameStats) {
        $this->assertEquals($this->handballStats->getPosition(), $gameStats->getPlayerStats()->getPosition());
        $this->assertEquals($this->handballStats->getGoalsMade(), $gameStats->getPlayerStats()->getGoalsMade());
        $this->assertEquals($this->handballStats->getGoalsReceived(), $gameStats->getPlayerStats()->getGoalsReceived());
    }
}