<?php

namespace App\Tests\Unit\Classes\Entity;

use App\Entity\Match;
use App\Entity\Team;
use App\Exceptions\InvalidMatchTeamsException;
use PHPUnit\Framework\TestCase;

abstract class MatchTest extends TestCase {

    protected function assertEmptyMatch(Match $match) {
        $this->assertEmptyMatchWinner($match);
        $this->assertNull($match->getMvpPlayerStats());
        $this->assertEmpty($match->getGameStats());
    }

    private function assertEmptyMatchWinner(Match $match) {
        $this->expectException(InvalidMatchTeamsException::class);
        $match->getWinner();
    }

    protected function assertOneTeamMatch(Match $match) {
        $this->assertEmptyMatchWinner($match);
        $this->assertNull($match->getMvpPlayerStats());
        $this->assertNotEmpty($match->getGameStats());
    }

    protected function assertMatchResult(Match $match, Team $winner) {
        $this->assertEquals($winner, $match->getWinner());
        $this->assertNotEmpty($match->getGameStats());
    }
}