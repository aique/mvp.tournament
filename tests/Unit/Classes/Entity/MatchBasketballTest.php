<?php

namespace App\Tests\Unit\Classes\Entity;

use App\Entity\Match;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\GameStatsGenerator;
use App\Tests\Unit\Utils\Generation\MatchGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\PlayerStatsGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;

class MatchBasketballTest extends MatchTest {

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
        $this->playerGenerator = new PlayerGenerator();
        $this->teamGenerator = new TeamGenerator();
        $this->gameStatsGenerator = new BasketballStatsGenerator();

        $this->playerStatsGenerator = new PlayerStatsGenerator(
            $this->playerGenerator,
            $this->teamGenerator,
            $this->gameStatsGenerator
        );

        $this->matchGenerator = new MatchGenerator($this->playerStatsGenerator);
    }

    public function testNoStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getNoStatsMatch();

        $this->assertEmptyMatch($match);
    }

    public function testEmptyStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getEmptyStatsMatch();

        $this->assertEmptyMatch($match);
    }

    public function testOneStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getOnePlayerStatsMatch([GameStatsGenerator::STATS_RANK_2]);
        $winner = $this->teamGenerator->getTeam(TeamGenerator::TEAM_1);
        $highestPlayerStat = $this->gameStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_2)->getPlayerScore();

        $this->assertOneTeamMatch($match, $winner, $highestPlayerStat);
    }

    public function testTwoStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getTwoPlayerStatsMatch([
            GameStatsGenerator::STATS_RANK_2,
            GameStatsGenerator::STATS_RANK_3
        ]);

        $winner = $this->teamGenerator->getTeam(TeamGenerator::TEAM_1);

        $this->assertMatchResult($match, $winner);
    }

    public function testFourStatsMatch() {
        /** @var Match $match */
        $match = $this->matchGenerator->getFourPlayerStatsMatch([
            GameStatsGenerator::STATS_RANK_2,
            GameStatsGenerator::STATS_RANK_4,
            GameStatsGenerator::STATS_RANK_3,
            GameStatsGenerator::STATS_RANK_1
        ]);

        $winner = $this->teamGenerator->getTeam(TeamGenerator::TEAM_2);

        $this->assertMatchResult($match, $winner);
    }
}