<?php

namespace App\Services\Input\Parse;

use App\Exceptions\WrongDataFileFormatException;

class InputStatsFileParserFactory {

    const BASKETBALL_STATS_TYPE = 1;
    const HANDBALL_STATS_TYPE = 2;

    const NUM_BASKETBALL_LINE_STATS = 8;
    const NUM_HANDBALL_LINE_STATS = 7;

    private $inputStatsLine;

    public function __construct($inputStatsLine) {
        $this->inputStatsLine = $inputStatsLine;
    }

    public function getInputStatsLine() {
        return $this->inputStatsLine;
    }

    public function setInputStatsLine($inputStatsLine) {
        $this->inputStatsLine = $inputStatsLine;
    }

    public function createFileParser() {
        switch ($this->getStatsType()) {
            case self::BASKETBALL_STATS_TYPE:
                return new BasketballStatsFileFileParser();
                break;
            case self::HANDBALL_STATS_TYPE:
                return new HandballStatsFileFileParser();
                break;
            default:
                throw new WrongDataFileFormatException();
        }
    }

    private function getStatsType() {
        $numStats = $this->getNumStats();

        if ($this->areBasketballStats($numStats)) {
            return self::BASKETBALL_STATS_TYPE;
        }

        if ($this->areHandballStats($numStats)) {
            return self::HANDBALL_STATS_TYPE;
        }

        return null;
    }

    private function getNumStats() {
        return count(explode(';', $this->inputStatsLine));
    }

    private function areBasketballStats($numStats) {
        return $numStats == self::NUM_BASKETBALL_LINE_STATS;
    }

    private function areHandballStats($numStats) {
        return $numStats == self::NUM_HANDBALL_LINE_STATS;
    }
}