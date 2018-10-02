<?php

namespace App\Tests\Unit\Classes\Services\Input;

use App\Entity\Player;
use App\Entity\Stats\GameStats;
use App\Entity\Team;
use App\Exceptions\InvalidStatsValuesException;
use App\Exceptions\WrongDataFileFormatException;
use App\Services\Input\Parse\InputStatsFileParser;
use PHPUnit\Framework\TestCase;

abstract class GameStatsFileParserTest extends TestCase {

    /** @var Player */
    protected $player;
    /** @var Team */
    protected $team;
    /** @var InputStatsFileParser */
    protected $gameStatsFileParser;

    protected function assertPlayer(GameStats $gameStat) {
        $this->assertEquals($this->player->getName(), $gameStat->getPlayer()->getName());
        $this->assertEquals($this->player->getNickname(), $gameStat->getPlayer()->getNickname());
    }

    protected function assertTeam(GameStats $gameStat) {
        $this->assertEquals($this->team->getName(), $gameStat->getTeam()->getName());
    }

    protected function assertInvalidStatsNumber($inputStatsLine) {
        $this->expectException(WrongDataFileFormatException::class);

        $this->gameStatsFileParser->parseGameStats($inputStatsLine);
    }

    protected function assertInvalidStatsValue($inputStatsLine) {
        $this->expectException(InvalidStatsValuesException::class);

        $this->gameStatsFileParser->parseGameStats($inputStatsLine);
    }
}