<?php

namespace App\Tests\Unit\Classes\Entity\Stats;

use App\Entity\Stats\BasketballStats;
use App\Exceptions\WrongDataFileFormatException;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use PHPUnit\Framework\TestCase;

class BasketballStatsTest extends TestCase {

    /** @var BasketballStats */
    private $basketballStats;
    /** @var BasketballStatsGenerator */
    private $basketballStatsGenerator;

    public function setUp() {
        $this->basketballStatsGenerator = new BasketballStatsGenerator();
        $this->basketballStats = $this->basketballStatsGenerator->getStats(BasketballStatsGenerator::STATS_RANK_1);
    }

    public function testConstructor() {
        $this->assertEquals(BasketballStatsGenerator::POSITION_STATS_1, $this->basketballStats->getPosition());
        $this->assertEquals(BasketballStatsGenerator::POINTS_STATS_1, $this->basketballStats->getPoints());
        $this->assertEquals(BasketballStatsGenerator::REBOUNDS_STATS_1, $this->basketballStats->getRebounds());
        $this->assertEquals(BasketballStatsGenerator::ASSISTS_STATS_1, $this->basketballStats->getAssists());
    }

    public function testInvalidPosition() {
        $this->expectException(WrongDataFileFormatException::class);

        new BasketballStats('wrong', 1, 2, 3);
    }

    public function testInvalidPoints() {
        $this->expectException(WrongDataFileFormatException::class);

        new BasketballStats(BasketballStats::GUARD_POSITION, -1, 2, 3);
    }

    public function testInvalidRebounds() {
        $this->expectException(WrongDataFileFormatException::class);

        new BasketballStats(BasketballStats::GUARD_POSITION, 1, -2, 3);
    }

    public function testInvalidAssists() {
        $this->expectException(WrongDataFileFormatException::class);

        new BasketballStats(BasketballStats::GUARD_POSITION, -1, 2, -3);
    }
}