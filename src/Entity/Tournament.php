<?php

namespace App\Entity;

use App\Services\TournamentStatsUtil;

class Tournament {

    private $year;
    /** @var array */
    private $matches;

    public function __construct($year) {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year) {
        $this->year = $year;
    }

    /**
     * @return array
     */
    public function getMatches() {
        return $this->matches;
    }

    /**
     * @param array $matches
     */
    public function setMatches($matches) {
        $this->matches = $matches;
    }

    /**
     * @param Match $match
     */
    public function addMatch($match) {
        $this->matches[] = $match;
    }

    public function getMVP() {
        return TournamentStatsUtil::getMVP($this->matches);
    }
}