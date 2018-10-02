<?php

namespace App\Tests\Unit\Classes\Services\Score;

use App\Services\Score\BasketballScoreCalculator;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use PHPUnit\Framework\TestCase;

class BasketballScoreCalculatorTest extends TestCase {

    /** @var BasketballStatsGenerator */
    private $basketballStatsGenerator;

    public function setUp() {
        $this->basketballStatsGenerator = new BasketballStatsGenerator();
    }

    public function testRank1Score() {
        $stats = $this->basketballStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_1);
        $basketballScoreCalculator = new BasketballScoreCalculator($stats);

        $this->assertEquals(BasketballStatsGenerator::STATS_RANK_1_SCORE, $basketballScoreCalculator->getPlayerScore());
        $this->assertEquals(BasketballStatsGenerator::POINTS_STATS_1, $basketballScoreCalculator->getTeamScore());
    }

    public function testRank2Score() {
        $stats = $this->basketballStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_2);
        $basketballScoreCalculator = new BasketballScoreCalculator($stats);

        $this->assertEquals(BasketballStatsGenerator::STATS_RANK_2_SCORE, $basketballScoreCalculator->getPlayerScore());
        $this->assertEquals(BasketballStatsGenerator::POINTS_STATS_2, $basketballScoreCalculator->getTeamScore());
    }

    public function testRank3Score() {
        $stats = $this->basketballStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_3);
        $basketballScoreCalculator = new BasketballScoreCalculator($stats);

        $this->assertEquals(BasketballStatsGenerator::STATS_RANK_3_SCORE, $basketballScoreCalculator->getPlayerScore());
        $this->assertEquals(BasketballStatsGenerator::POINTS_STATS_3, $basketballScoreCalculator->getTeamScore());
    }

    public function testRank4Score() {
        $stats = $this->basketballStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_4);
        $basketballScoreCalculator = new BasketballScoreCalculator($stats);

        $this->assertEquals(BasketballStatsGenerator::STATS_RANK_4_SCORE, $basketballScoreCalculator->getPlayerScore());
        $this->assertEquals(BasketballStatsGenerator::POINTS_STATS_4, $basketballScoreCalculator->getTeamScore());
    }
}