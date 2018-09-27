<?php

namespace App\Tests\Unit\Classes\Services\Score;

use App\Services\Score\HandballScoreCalculator;
use App\Tests\Unit\Utils\Generation\HandballStatsGenerator;
use PHPUnit\Framework\TestCase;

class HandballScoreCalculatorTest extends TestCase {

    /** @var HandballStatsGenerator */
    private $handballStatsGenerator;

    public function setUp() {
        $this->handballStatsGenerator = new HandballStatsGenerator();
    }

    public function testRank1Score() {
        $stats = $this->handballStatsGenerator->getStats(HandballStatsGenerator::STATS_RANK_1);
        $handballScoreCalculator = new HandballScoreCalculator($stats);

        $this->assertEquals(HandballStatsGenerator::STATS_RANK_1_SCORE, $handballScoreCalculator->getPlayerScore());
        $this->assertEquals(HandballStatsGenerator::GOAL_MADE_STATS_1, $handballScoreCalculator->getMatchScore());
    }

    public function testRank2Score() {
        $stats = $this->handballStatsGenerator->getStats(HandballStatsGenerator::STATS_RANK_2);
        $handballScoreCalculator = new HandballScoreCalculator($stats);

        $this->assertEquals(HandballStatsGenerator::STATS_RANK_2_SCORE, $handballScoreCalculator->getPlayerScore());
        $this->assertEquals(HandballStatsGenerator::GOAL_MADE_STATS_2, $handballScoreCalculator->getMatchScore());
    }

    public function testRank3Score() {
        $stats = $this->handballStatsGenerator->getStats(HandballStatsGenerator::STATS_RANK_3);
        $handballScoreCalculator = new HandballScoreCalculator($stats);

        $this->assertEquals(HandballStatsGenerator::STATS_RANK_3_SCORE, $handballScoreCalculator->getPlayerScore());
        $this->assertEquals(HandballStatsGenerator::GOAL_MADE_STATS_3, $handballScoreCalculator->getMatchScore());
    }

    public function testRank4Score() {
        $stats = $this->handballStatsGenerator->getStats(HandballStatsGenerator::STATS_RANK_4);
        $handballScoreCalculator = new HandballScoreCalculator($stats);

        $this->assertEquals(HandballStatsGenerator::STATS_RANK_4_SCORE, $handballScoreCalculator->getPlayerScore());
        $this->assertEquals(HandballStatsGenerator::GOAL_MADE_STATS_4, $handballScoreCalculator->getMatchScore());
    }
}