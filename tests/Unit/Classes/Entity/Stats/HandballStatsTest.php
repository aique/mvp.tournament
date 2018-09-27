<?php

namespace App\Tests\Unit\Classes\Entity\Stats;

use App\Entity\Stats\HandballStats;
use App\Exceptions\WrongDataFileFormatException;
use App\Tests\Unit\Utils\Generation\HandballStatsGenerator;
use PHPUnit\Framework\TestCase;

class HandballStatsTest extends TestCase {

    /** @var HandballStats */
    private $handballStats;
    /** @var HandballStatsGenerator */
    private $handballStatsGenerator;

    public function setUp() {
        $this->handballStatsGenerator = new HandballStatsGenerator();
        $this->handballStats = $this->handballStatsGenerator->getStats(HandballStatsGenerator::STATS_RANK_1);
    }

    public function testConstructor() {
        $this->assertEquals(HandballStatsGenerator::POSITION_STATS_1, $this->handballStats->getPosition());
        $this->assertEquals(HandballStatsGenerator::GOAL_MADE_STATS_1, $this->handballStats->getGoalMade());
        $this->assertEquals(HandballStatsGenerator::GOAL_RECEIVED_STATS_1, $this->handballStats->getGoalReceived());
    }

    public function testInvalidPosition() {
        $this->expectException(WrongDataFileFormatException::class);

        new HandballStats('wrong', 1, 2, 3);
    }

    public function testInvalidPoints() {
        $this->expectException(WrongDataFileFormatException::class);

        new HandballStats(HandballStats::GOALKEEPER_POSITION, -1, 2);
    }

    public function testInvalidRebounds() {
        $this->expectException(WrongDataFileFormatException::class);

        new HandballStats(HandballStats::GOALKEEPER_POSITION, 1, -2);
    }
}