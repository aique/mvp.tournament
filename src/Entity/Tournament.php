<?php

namespace App\Entity;

use App\Services\TournamentMVPFinder;

class Tournament {

    private $year;
    /** @var array */
    private $matches;
    /** @var TournamentMVPFinder */
    private $mvpFinder;

    public function __construct($year, TournamentMVPFinder $mvpFinder) {
        $this->year = $year;
        $this->matches = [];
        $this->mvpFinder = $mvpFinder;
    }

    /**
     * @return mixed
     */
    public function getYear() {
        return $this->year;
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

    public function getMVPs() {
        return $this->mvpFinder->getMVPs($this->matches);
    }
}