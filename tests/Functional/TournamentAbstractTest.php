<?php

namespace App\Tests\Functional;

use App\Entity\Match;
use App\Entity\Player;
use App\Entity\Tournament\Tournament;
use App\Services\Input\MatchReader;
use PHPUnit\Framework\TestCase;

abstract class TournamentAbstractTest extends TestCase {

    /** @var Tournament */
    protected $tournament;
    protected $tournamentMatchesPath;

    protected function createMatches() {
        $matches = [];

        $filesInMatchesPath = array_diff(scandir($this->tournamentMatchesPath), array('.', '..'));

        foreach ($filesInMatchesPath as $matchFile) {
            try {
                $matchReader = new MatchReader($this->tournamentMatchesPath.'/'.$matchFile);
                $matches[] = $matchReader->getMatch();
            } catch (\Exception $ex) {}
        }

        return $matches;
    }

    protected function assertMatchWinner($matches, $matchNum, $winner) {
        $match1 = $matches[$matchNum];

        $this->assertInstanceOf(Match::class, $match1);
        $this->assertEquals($winner, $match1->getWinner()->getName());
    }

    protected function assertMvpNames(array $players) {
        $mvps = $this->tournament->getMVPs();

        $this->assertCount(count($players), $mvps);

        foreach ($players as $player) {
            $playerInMvpArray = $this->isPlayerInMvpsArray($player, $mvps);
            $this->assertTrue($playerInMvpArray);
        }
    }

    private function isPlayerInMvpsArray(Player $player, array $mvps) {
        foreach ($mvps as $mvp) {
            if ($player->getNickname() == $mvp->getNickname()) {
                return true;
            }
        }

        return false;
    }
}