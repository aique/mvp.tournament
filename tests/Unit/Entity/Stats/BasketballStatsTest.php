<?php

namespace App\Tests\Unit\Entity\Stats;

use App\Entity\Stats\BasketballStats;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use PHPUnit\Framework\TestCase;

class BasketballStatsTest extends TestCase {

    /** @var BasketballStats */
    private $basketballStats;
    /** @var BasketballStatsGenerator */
    private $basketballStatsGenerator;

    public function setUp() {
        $this->basketballStatsGenerator = new BasketballStatsGenerator();
        $this->basketballStats = $this->basketballStatsGenerator->getStats();
    }

    public function testConstructor() {
        self::assertEquals($this->basketballStats->getPosition(), BasketballStatsGenerator::POSITION);
        self::assertEquals($this->basketballStats->getPoints(), BasketballStatsGenerator::POINTS);
        self::assertEquals($this->basketballStats->getRebounds(), BasketballStatsGenerator::REBOUNDS);
        self::assertEquals($this->basketballStats->getAssists(), BasketballStatsGenerator::ASSISTS);
    }
}