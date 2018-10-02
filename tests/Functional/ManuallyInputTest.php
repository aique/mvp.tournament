<?php

namespace App\Tests\Functional;

use App\Entity\Player;
use App\Entity\Stats\HandballStats;
use App\Entity\Team;
use App\Entity\Match;
use App\Entity\Stats\GameStats;
use App\Entity\Stats\BasketballStats;
use App\Entity\Tournament\Tournament;
use App\Services\MatchWinnerFinder;
use PHPUnit\Framework\TestCase;

class ManuallyInputTest extends TestCase {

    private $tournament;

    private $match1;
    private $match2;

    private $teamA;
    private $teamB;
    private $teamC;
    private $teamD;

    private $player1;
    private $player2;
    private $player3;
    private $player4;
    private $player5;
    private $player6;
    private $player7;
    private $player8;

    public function setUp() {
        $this->tournament = new Tournament(2018);

        $this->match1 = $this->getMatch1();
        $this->match2 = $this->getMatch2();

        $this->tournament->addMatch($this->match1);
        $this->tournament->addMatch($this->match2);
    }

    private function getMatch1() {
        $this->teamA = new Team("Team A");
        $this->teamB = new Team("Team B");

        $this->player1 = new Player("Miguel", "miguel");
        $this->player2 = new Player("Marta", "marta");
        $this->player3 = new Player("Manuel", "manuel");
        $this->player4 = new Player("Maria", "maria");

        $matchStats = [
            new GameStats($this->player1, $this->teamA, new BasketballStats(BasketballStats::GUARD_POSITION, 10, 2, 4)),
            new GameStats($this->player2, $this->teamA, new BasketballStats(BasketballStats::CENTER_POSITION, 4, 6, 2)),
            new GameStats($this->player3, $this->teamB, new BasketballStats(BasketballStats::FORWARD_POSITION, 18, 0, 1)),
            new GameStats($this->player4, $this->teamB, new BasketballStats(BasketballStats::CENTER_POSITION, 5, 8, 1))
        ];

        $match = new Match(new MatchWinnerFinder());
        $match->setGameStats($matchStats);

        return $match;
    }

    private function getMatch2() {
        $this->teamC = new Team("Team C");
        $this->teamD = new Team("Team D");

        $this->player5 = new Player("Antonio", "antonio");
        $this->player6 = new Player("Ana", "ana");
        $this->player7 = new Player("Abel", "abel");
        $this->player8 = new Player("Alicia", "alicia");

        $matchStats = [
            new GameStats($this->player5, $this->teamC, new HandballStats(HandballStats::GOALKEEPER_POSITION, 2, 1)),
            new GameStats($this->player6, $this->teamC, new HandballStats(HandballStats::FIELD_PLAYER_POSITION, 4, 2)),
            new GameStats($this->player7, $this->teamD, new HandballStats(HandballStats::GOALKEEPER_POSITION, 3, 3)),
            new GameStats($this->player8, $this->teamD, new HandballStats(HandballStats::FIELD_PLAYER_POSITION, 7, 4))
        ];

        $match = new Match(new MatchWinnerFinder());
        $match->setGameStats($matchStats);

        return $match;
    }

    public function testMain() {
        $this->assertEquals($this->teamB, $this->match1->getWinner());
        $this->assertEquals($this->teamD, $this->match2->getWinner());

        $this->assertContains($this->player7, $this->tournament->getMVPs());
    }
}
