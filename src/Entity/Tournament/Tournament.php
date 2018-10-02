<?php

namespace App\Entity\Tournament;

class Tournament {

    private $year;
    /** @var array */
    private $matches;

    public function __construct($year) {
        $this->year = $year;
        $this->matches = [];
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
        $tournamentScoreTable = new TournamentScoreTable($this->matches);

        return $tournamentScoreTable->getMvps();
    }
}