<?php

namespace App\Tests\Integration;

use App\Entity\Stats\HandballStats;
use App\Services\Input\MatchReader;

class HandballlMatchReaderTest extends MatchReaderTest {

    public function setUp() {
        $this->inputFilePath = __DIR__ . '/Resources/Input/handball-match-1';
        $this->matchReader = new MatchReader($this->inputFilePath);
    }

    public function testTeamsReader() {
        $this->assertNotNull($this->matchReader->getMatch());
        $gameStats = $this->matchReader->getMatch()->getGameStats();
        $this->assertCount(6, $gameStats);

        $playerStatExpected = new HandballStats(HandballStats::GOALKEEPER_POSITION, 0, 20);
        $playerStatFound = $gameStats[0]->getPlayerStats();

        $this->assertBasketballStats($playerStatExpected, $playerStatFound);

        $playerStatExpected = new HandballStats(HandballStats::FIELD_PLAYER_POSITION, 15, 20);
        $playerStatFound = $gameStats[1]->getPlayerStats();

        $this->assertBasketballStats($playerStatExpected, $playerStatFound);

        $playerStatExpected = new HandballStats(HandballStats::FIELD_PLAYER_POSITION, 8, 25);
        $playerStatFound = $gameStats[5]->getPlayerStats();

        $this->assertBasketballStats($playerStatExpected, $playerStatFound);
    }

    private function assertBasketballStats($playerStatExpected, $playerStatFound) {
        $this->assertInstanceOf(HandballStats::class, $playerStatFound);

        $this->assertEquals($playerStatExpected->getPosition(), $playerStatFound->getPosition());
        $this->assertEquals($playerStatExpected->getGoalsMade(), $playerStatFound->getGoalsMade());
        $this->assertEquals($playerStatExpected->getGoalsReceived(), $playerStatFound->getGoalsReceived());
    }
}