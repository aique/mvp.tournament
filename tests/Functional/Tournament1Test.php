<?php

namespace App\Tests\Functional;

use App\Entity\Match;
use App\Entity\Player;
use App\Entity\Tournament\Tournament;

class Tournament1Test extends TournamentAbstractTest {

    const TOURNAMENT_MATCHES_PATH = __DIR__.'/Resources/Input/Tournament1';
    const NUM_MATCHES = 1;

    public function setUp() {
        $this->tournamentMatchesPath = self::TOURNAMENT_MATCHES_PATH;
        $this->tournament = new Tournament(2018);
        $this->tournament->setMatches($this->createMatches());
    }

    public function testMain() {
        $matches = $this->tournament->getMatches();

        $this->assertCount(self::NUM_MATCHES, $matches);
        $this->assertMatchWinner($matches, 0, 'Team​ ​ B');
        $this->assertMvpNames([new Player('player​ ​ 3', 'nick3')]);
    }
}