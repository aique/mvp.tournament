<?php

namespace App\Tests\Unit\Classes\Entity;

use App\Entity\Player;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase {

    /** @var Player */
    private $player;
    /** @var PlayerGenerator */
    private $playerGenerator;

    public function setUp() {
        $this->playerGenerator = new PlayerGenerator();
        $this->player = $this->playerGenerator->getPlayer(PlayerGenerator::PLAYER_1);
    }

    public function testConstructor() {
        $this->assertEquals(PlayerGenerator::NAME_PLAYER_1, $this->player->getName());
        $this->assertEquals(PlayerGenerator::NICKNAME_PLAYER_1, $this->player->getNickname());
    }

    public function testNameSetter() {
        $this->player->setName(PlayerGenerator::NAME_PLAYER_2);
        $this->assertEquals(PlayerGenerator::NAME_PLAYER_2, $this->player->getName());
    }

    public function testNicknameSetter() {
        $this->player->setNickname(PlayerGenerator::NICKNAME_PLAYER_2);
        $this->assertEquals(PlayerGenerator::NICKNAME_PLAYER_2, $this->player->getNickname());
    }
}