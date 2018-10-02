<?php

namespace App\Tests\Integration;

use App\Entity\Stats\BasketballStats;
use App\Services\Input\MatchReader;

class BasketballMatchReaderTest extends MatchReaderTest {

    public function setUp() {
        $this->inputFilePath = __DIR__ . '/Resources/Input/basketball-match-1';
        $this->matchReader = new MatchReader($this->inputFilePath);
    }

    public function testTeamsReader() {
        $this->assertNotNull($this->matchReader->getMatch());
        $gameStats = $this->matchReader->getMatch()->getGameStats();
        $this->assertCount(6, $gameStats);

        $playerStatExpected = new BasketballStats(BasketballStats::GUARD_POSITION, 10, 2, 7);
        $playerStatFound = $gameStats[0]->getPlayerStats();

        $this->assertBasketballStats($playerStatExpected, $playerStatFound);

        $playerStatExpected = new BasketballStats(BasketballStats::FORWARD_POSITION, 0, 10, 0);
        $playerStatFound = $gameStats[1]->getPlayerStats();

        $this->assertBasketballStats($playerStatExpected, $playerStatFound);

        $playerStatExpected = new BasketballStats(BasketballStats::CENTER_POSITION, 8, 10, 0);
        $playerStatFound = $gameStats[5]->getPlayerStats();

        $this->assertBasketballStats($playerStatExpected, $playerStatFound);
    }

    private function assertBasketballStats($playerStatExpected, $playerStatFound) {
        $this->assertInstanceOf(BasketballStats::class, $playerStatFound);

        $this->assertEquals($playerStatExpected->getPosition(), $playerStatFound->getPosition());
        $this->assertEquals($playerStatExpected->getPoints(), $playerStatFound->getPoints());
        $this->assertEquals($playerStatExpected->getRebounds(), $playerStatFound->getRebounds());
        $this->assertEquals($playerStatExpected->getAssists(), $playerStatFound->getAssists());
    }
}