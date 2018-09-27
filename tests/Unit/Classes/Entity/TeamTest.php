<?php

namespace App\Tests\Unit\Classes\Entity;

use App\Entity\Team;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase {

    /** @var Team */
    private $team;
    /** @var TeamGenerator */
    private $teamGenerator;

    public function setUp() {
        $this->teamGenerator = new TeamGenerator();
        $this->team = $this->teamGenerator->getTeam(TeamGenerator::TEAM_1);
    }

    public function testConstructor() {
        $this->assertEquals(TeamGenerator::NAME_TEAM_1, $this->team->getName());
    }

    public function testNameSetter() {
        $this->team->setName(TeamGenerator::NAME_TEAM_2);
        $this->assertEquals(TeamGenerator::NAME_TEAM_2, $this->team->getName());
    }
}