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
}