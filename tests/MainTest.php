<?php

namespace App\Tests;

use App\Entity\Player;
use App\Entity\Stats\HandballStats;
use App\Entity\Team;
use App\Entity\Match;
use App\Entity\Stats\PlayerStats;
use App\Entity\Stats\BasketballStats;
use App\Entity\Tournament;
use App\Services\Score\BasketballPlayerScoreUtil;
use App\Services\Score\HandballPlayerScoreUtil;
use PHPUnit\Framework\TestCase;

class MainTest extends TestCase {

    public function testMain() {
        $tournament = new Tournament(2018);

        $teamA = new Team("Team A");
        $teamB = new Team("Team B");

        $player1 = new Player("Miguel", "miguel");
        $player2 = new Player("Marta", "marta");
        $player3 = new Player("Manuel", "manuel");
        $player4 = new Player("Maria", "maria");

        $match1 = new Match(Match::BASKETBALL_MATCH);

        $matchStats = [
            new PlayerStats($player1, $teamA, $match1, new BasketballStats(BasketballPlayerScoreUtil::GUARD_POSITION, 10, 2, 4)),
            new PlayerStats($player2, $teamA, $match1, new BasketballStats(BasketballPlayerScoreUtil::CENTER_POSITION, 4, 6, 2)),
            new PlayerStats($player3, $teamB, $match1, new BasketballStats(BasketballPlayerScoreUtil::FORWARD_POSITION, 18, 0, 1)),
            new PlayerStats($player4, $teamB, $match1, new BasketballStats(BasketballPlayerScoreUtil::CENTER_POSITION, 5, 8, 1))
        ];

        $match1->setStats($matchStats);

        $this->assertTrue($match1->getWinner() == $teamB);

        $tournament->addMatch($match1);

        $teamC = new Team("Team C");
        $teamD = new Team("Team D");

        $player5 = new Player("Antonio", "antonio");
        $player6 = new Player("Ana", "ana");
        $player7 = new Player("Abel", "abel");
        $player8 = new Player("Alicia", "alicia");

        $match2 = new Match(Match::HANDBALL_MATCH);

        $matchStats = [
            new PlayerStats($player5, $teamC, $match2, new HandballStats(HandballPlayerScoreUtil::GOALKEEPER_POSITION, 2, 1)),
            new PlayerStats($player6, $teamC, $match2, new HandballStats(HandballPlayerScoreUtil::FIELD_PLAYER_POSITION, 4, 2)),
            new PlayerStats($player7, $teamD, $match2, new HandballStats(HandballPlayerScoreUtil::GOALKEEPER_POSITION, 3, 3)),
            new PlayerStats($player8, $teamD, $match2, new HandballStats(HandballPlayerScoreUtil::FIELD_PLAYER_POSITION, 7, 4))
        ];

        $match2->setStats($matchStats);

        $this->assertTrue($match2->getWinner() == $teamD);

        $tournament->addMatch($match2);

        $this->assertEquals($tournament->getMVP(), $player7->getNickname());
    }
}
