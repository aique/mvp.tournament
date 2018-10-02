<?php

namespace App\Services\Input\Parse;

use App\Entity\Player;
use App\Entity\Stats\GameStats;
use App\Entity\Stats\PlayerStats;
use App\Entity\Team;
use App\Exceptions\WrongDataFileFormatException;

abstract class InputStatsFileParser {

    const PLAYER_NAME_STATS_POSITION = 0;
    const PLAYER_NICK_STATS_POSITION = 1;
    const TEAM_NAME_STATS_POSITION = 3;

    private $numStatsPerLine;

    public function __construct($numFileStats) {
        $this->numStatsPerLine = $numFileStats;
    }

    /**
     * @param $inputStatsLine
     * @return GameStats
     * @throws WrongDataFileFormatException
     */
    public function parseGameStats($inputStatsLine) {
        $gameStatsArray = $this->getGameStatsArray($inputStatsLine);

        if (count($gameStatsArray) != $this->numStatsPerLine) {
            throw new WrongDataFileFormatException();
        }

        $player = $this->parsePlayer($gameStatsArray);
        $team = $this->parseTeam($gameStatsArray);
        $gameStats = $this->parsePlayerStats($gameStatsArray);

        return new GameStats($player, $team, $gameStats);
    }

    protected function getGameStatsArray($inputStatsLine) {
        return explode(';', $inputStatsLine);
    }

    private function parsePlayer(array $gameStatsArray) {
        return new Player(
            $gameStatsArray[self::PLAYER_NAME_STATS_POSITION],
            $gameStatsArray[self::PLAYER_NICK_STATS_POSITION]
        );
    }

    private function parseTeam(array $gameStatsArray) {
        return new Team($gameStatsArray[self::TEAM_NAME_STATS_POSITION]);
    }

    /**
     * @return PlayerStats
     */
    protected abstract function parsePlayerStats(array $gameStatsArray);
}