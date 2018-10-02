<?php

namespace App\Tests\Unit\Classes\Services\Input;

use App\Entity\Player;
use App\Entity\Stats\BasketballStats;
use App\Entity\Stats\GameStats;
use App\Entity\Team;
use App\Services\Input\Parse\BasketballStatsFileFileParser;

class BasketballStatsFileFileParserTest extends GameStatsFileParserTest {

    private $inputStatsLine;
    /** @var BasketballStats */
    private $basketballStats;

    public function setUp() {
        $this->inputStatsLine = 'player​ ​ 1;nick1;4;Team​ ​ A;G;10;2;7';
        $this->player = new Player('player​ ​ 1', 'nick1');
        $this->team = new Team('Team​ ​ A');
        $this->basketballStats = new BasketballStats('G', 10, 2, 7);
        $this->gameStatsFileParser = new BasketballStatsFileFileParser();
    }

    public function testObtainGameStat() {
        $gameStat = $this->gameStatsFileParser->parseGameStats($this->inputStatsLine);

        $this->assertNotNull($gameStat);
        $this->assertPlayer($gameStat);
        $this->assertTeam($gameStat);
        $this->assertStats($gameStat);
    }

    public function testInvalidPosition() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;Z;10;2;7');
    }

    public function testInvalidNumericPosition() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;5;10;2;7');
    }

    public function testInvalidEmptyPosition() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;10;2;7');
    }

    public function testInvalidPoints() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;-10;2;7');
    }

    public function testInvalidNoNumericPoints() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;A;2;7');
    }

    public function testInvalidEmptyPoints() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;G;2;7');
    }

    public function testInvalidRebounds() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;10;-2;7');
    }

    public function testInvalidNoNumericRebounds() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;10;A;7');
    }

    public function testInvalidEmptyRebounds() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;G;10;7');
    }

    public function testInvalidAssists() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;10;2;-7');
    }

    public function testInvalidNoNumericAssists() {
        $this->assertInvalidStatsValue('player​ ​ 1;nick1;4;Team​ ​ A;G;10;2;A');
    }

    public function testInvalidEmptyAssists() {
        $this->assertInvalidStatsNumber('player​ ​ 1;nick1;4;Team​ ​ A;G;10;2');
    }

    private function assertStats(GameStats $gameStats) {
        $this->assertEquals($this->basketballStats->getPosition(), $gameStats->getPlayerStats()->getPosition());
        $this->assertEquals($this->basketballStats->getPoints(), $gameStats->getPlayerStats()->getPoints());
        $this->assertEquals($this->basketballStats->getRebounds(), $gameStats->getPlayerStats()->getRebounds());
        $this->assertEquals($this->basketballStats->getAssists(), $gameStats->getPlayerStats()->getAssists());
    }
}