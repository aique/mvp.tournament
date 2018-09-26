<?php

namespace App\Tests\Unit\Entity\Stats;

use App\Entity\Stats\HandballStats;
use App\Tests\Unit\Utils\Generation\HandballStatsGenerator;
use PHPUnit\Framework\TestCase;

class HandballStatsTest extends TestCase {

    /** @var HandballStats */
    private $handballStats;
    /** @var HandballStatsGenerator */
    private $handballStatsGenerator;

    public function setUp() {
        $this->handballStatsGenerator = new HandballStatsGenerator();
        $this->handballStats = $this->handballStatsGenerator->getStats();
    }

    public function testConstructor() {
        self::assertEquals($this->handballStats->getPosition(), HandballStatsGenerator::POSITION);
        self::assertEquals($this->handballStats->getGoalMade(), HandballStatsGenerator::GOAL_MADE);
        self::assertEquals($this->handballStats->getGoalReceived(), HandballStatsGenerator::GOAL_RECEIVED);
    }
}