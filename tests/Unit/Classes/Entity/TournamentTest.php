<?php

namespace App\Tests\Unit\Classes\Entity;

use App\Entity\Tournament;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\GameStatsGenerator;
use App\Tests\Unit\Utils\Generation\MatchGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\PlayerStatsGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use App\Tests\Unit\Utils\Generation\TournamentGenerator;
use PHPUnit\Framework\TestCase;

class TournamentTest extends TestCase {

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

    public function testConstructor() {
        $this->assertEquals(TournamentGenerator::YEAR, $this->tournament->getYear());
        $this->assertEmpty($this->tournament->getMatches());
        $this->assertEmpty($this->tournament->getMVPs());
    }

    public function testMatchesSetter() {
        $this->tournament->setMatches([
            $this->matchGenerator->getEmptyStatsMatch()
        ]);

        $this->assertEquals(1, count($this->tournament->getMatches()));
    }

    public function testAddMatches() {
        $this->tournament->addMatch($this->matchGenerator->getEmptyStatsMatch());

        $this->assertEquals(1, count($this->tournament->getMatches()));
    }

    public function testNoStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getNoStatsMatch()
        ]);

        $this->assertEmpty($this->tournament->getMVPs()); // TODO necesario hacer un mock del servicio
    }

    public function testEmptyStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getEmptyStatsMatch()
        ]);

        $this->assertEmpty($this->tournament->getMVPs()); // TODO necesario hacer un mock del servicio
    }

    public function testOnePlayerStatsMatch() {
        $this->tournament->setMatches([
            $this->matchGenerator->getOnePlayerStatsMatch([GameStatsGenerator::STATS_RANK_2])
        ]);

        $this->assertMVPNames([
            PlayerGenerator::NICKNAME_PLAYER_1
        ]);
    }

    private function assertMVPNames(array $names) {
        $mvps = $this->tournament->getMVPs();

        $this->assertNotNull($mvps); // TODO necesario hacer un mock del servicio
        $this->assertEquals(count($names), count($mvps)); // TODO necesario hacer un mock del servicio

        foreach ($names as $name) {
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

        $this->assertMVPNames([
            PlayerGenerator::NICKNAME_PLAYER_1
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

        $this->assertMVPNames([
            PlayerGenerator::NICKNAME_PLAYER_4
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

        $this->assertMVPNames([
            PlayerGenerator::NICKNAME_PLAYER_4
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
                GameStatsGenerator::STATS_RANK_2,
                GameStatsGenerator::STATS_RANK_4
            ]),
        ]);

        $this->assertMVPNames([
            PlayerGenerator::NICKNAME_PLAYER_1,
            PlayerGenerator::NICKNAME_PLAYER_4
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

        $this->assertMVPNames([
            PlayerGenerator::NICKNAME_PLAYER_2
        ]);
    }
}