<?php

namespace App\Tests\Unit\Classes\Entity;


use App\Entity\Match;
use App\Entity\Team;
use PHPUnit\Framework\TestCase;

abstract class MatchTest extends TestCase {

    protected function assertEmptyMatch(Match $match) { // TODO necesario hacer un mock del servicio
        $this->assertNull($match->getWinner());
        $this->assertNull($match->getHighestPlayerStat());
        $this->assertEmpty($match->getStats());
    }

    protected function assertMatchResult(Match $match, Team $winner, $highestPlayerStat) { // TODO necesario hacer un mock del servicio
        $this->assertEquals($winner, $match->getWinner());
        $this->assertEquals($highestPlayerStat, $match->getHighestPlayerStat()->getPlayerScore());
        $this->assertNotEmpty($match->getStats());
    }
}