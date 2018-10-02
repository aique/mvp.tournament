<?php

namespace App\Tests\Integration;

use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\GameStatsGenerator;
use App\Tests\Unit\Utils\Generation\MatchGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\PlayerStatsGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use App\Tests\Unit\Utils\Generation\TournamentGenerator;
use PHPUnit\Framework\TestCase;

class FindMvpTest extends TestCase {

    /** @var Tournament */
    private $tournament;
    /** @var TournamentGenerator */
    private $tournamentGenerator;
    /** @var MatchGenerator */
    private $matchGenerator;
    /** @var PlayerStatsGenerator */
    private $playerStatsGenerator;
    /** @var PlayerGenerator */
    private $playerGenerator;
    /** @var TeamGenerator */
    private $teamGenerator;
    /** @var GameStatsGenerator */
    private $gameStatsGenerator;

    public function setUp() {
        $this->tournamentGenerator = new TournamentGenerator();

        $this->playerGenerator = new PlayerGenerator();
        $this->teamGenerator = new TeamGenerator();
        $this->gameStatsGenerator = new BasketballStatsGenerator();

        $this->playerStatsGenerator = new PlayerStatsGenerator(
            $this->playerGenerator,
            $this->teamGenerator,
            $this->gameStatsGenerator
        );

        $this->matchGenerator = new MatchGenerator($this->playerStatsGenerator);

        $this->tournament = $this->tournamentGenerator->createTournament();
    }

    public function testNoStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getNoStatsMatch()
        ]);

        $this->assertEmpty($this->tournament->getMVPs());
    }

    public function testEmptyStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getEmptyStatsMatch()
        ]);

        $this->assertEmpty($this->tournament->getMVPs());
    }

    public function testOnePlayerStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getOnePlayerStatsMatch([GameStatsGenerator::STATS_RANK_2])
        ]);

        $this->assertMvpPlayers([]);
    }

    private function assertMvpPlayers(array $players) {
        $mvps = $this->tournament->getMVPs();

        $this->assertNotNull($mvps);
        $this->assertEquals(count($players), count($mvps));

        foreach ($players as $name) {
            $this->assertContains($name, $mvps);
        }
    }

    public function testTwoPlayerStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getTwoPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_3
            ])
        ]);

        $this->assertMvpPlayers([
            $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_1)
        ]);
    }

    public function testFourPlayerStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4,
                GameStatsGenerator::STATS_RANK_3,
                GameStatsGenerator::STATS_RANK_1
            ])
        ]);

        $this->assertMvpPlayers([
            $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_4)
        ]);
    }

    public function testMvpTwoMatches() {
        $this->tournament->setMatches([
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4,
                GameStatsGenerator::STATS_RANK_3,
                GameStatsGenerator::STATS_RANK_1
            ]),
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_3,
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4
            ]),
        ]);

        $this->assertMvpPlayers([
            $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_1)
        ]);
    }

    public function testMvpTie() {
        $this->tournament->setMatches([
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4,
                GameStatsGenerator::STATS_RANK_3,
                GameStatsGenerator::STATS_RANK_1
            ]),
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_1,
                GameStatsGenerator::STATS_RANK_3,
                GameStatsGenerator::STATS_RANK_4,
                GameStatsGenerator::STATS_RANK_2
            ]),
        ]);

        $this->assertMvpPlayers([
            $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_1),
            $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_4)
        ]);
    }

    public function testMvpThreeMatches() {
        $this->tournament->setMatches([
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4,
                GameStatsGenerator::STATS_RANK_3,
                GameStatsGenerator::STATS_RANK_1
            ]),
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_1,
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4
            ]),
            $this->matchGenerator->getFourPlayerStatsMatch([
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_1,
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4
            ]),
        ]);

        $this->assertMvpPlayers([
            $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_2)
        ]);
    }
}