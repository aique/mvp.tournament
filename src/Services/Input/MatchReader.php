<?php

namespace App\Services\Input;

use App\Entity\Match;
use App\Exceptions\WrongInputFilePathException;
use App\Services\Input\Parse\InputStatsFileParserFactory;
use App\Services\MatchWinnerFinder;

class MatchReader {

    private $inputFilePath;
    /** @var Match */
    private $match;

    public function __construct($inputFilePath) {
        $this->inputFilePath = $inputFilePath;
        $this->match = $this->createMatchFromInput();
    }

    public function getMatch() {
        return $this->match;
    }

    public function getInputFilePath() {
        return $this->inputFilePath;
    }

    private function createMatchFromInput() {
        $fileContent = $this->readInputFileContent();
        $gameStats = $this->obtainGameStats($fileContent);

        $match = new Match(new MatchWinnerFinder());
        $match->setGameStats($gameStats);

        return $match;
    }

    private function readInputFileContent() {
        if (file_exists($this->inputFilePath)) {
            return file_get_contents($this->inputFilePath);
        }

        throw new WrongInputFilePathException();
    }

    private function obtainGameStats($fileContent) {
        $gameStats = [];

        $playerStatsParser = null;
        $playerStats = explode("\n", $fileContent);

        foreach ($playerStats as $playerStat) {
            $gameStats[] = $this->obtainGameStat($playerStatsParser, $playerStat);
        }

        return $gameStats;
    }

    private function obtainGameStat($playerStatsParser, $playerStat) {
        $playerStatsParser = $this->createParserIfNeeded($playerStatsParser, $playerStat);

        return $playerStatsParser->parseGameStats($playerStat);
    }

    private function createParserIfNeeded($playerStatsParser, $playerStat) {
        if (!$playerStatsParser) {
            $statsParserFactory = new InputStatsFileParserFactory($playerStat);
            $playerStatsParser = $statsParserFactory->createFileParser();
        }

        return $playerStatsParser;
    }
}