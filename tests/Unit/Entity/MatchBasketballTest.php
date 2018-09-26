<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Match;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\MatchGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\PlayerStatsGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use PHPUnit\Framework\TestCase;

class MatchBasketballTest extends TestCase {

    /** @var MatchGenerator */
    private $matchGenerator;
    /** @var PlayerStatsGenerator */
    private $playerStatsGenerator;

    public function setUp() {
        $this->playerStatsGenerator = new PlayerStatsGenerator(
            new PlayerGenerator(),
            new TeamGenerator(),
            new BasketballStatsGenerator());

        $this->matchGenerator = new MatchGenerator($this->playerStatsGenerator);
    }

    public function testEmptyStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getEmptyStatsMatch();

        $this->assertNull($match->getWinner());
        $this->assertNull($match->getHighestPlayerStat());
        $this->assertEmpty($match->getStats());
    }

    public function testOneStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getOnePlayerStatsMatch();
        $winner = $this->playerStatsGenerator->getPlayerStats()->getTeam();
        $highestPlayerStat = $this->playerStatsGenerator->getPlayerStats()->getPlayerScore();

        $this->assertEquals($match->getWinner(), $winner);
        $this->assertEquals($match->getHighestPlayerStat()->getPlayerScore(), $highestPlayerStat);
        $this->assertNotEmpty($match->getStats());
    }
}