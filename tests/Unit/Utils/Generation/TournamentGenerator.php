<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Tournament;
use App\Services\TournamentMVPFinder;

class TournamentGenerator {

    const YEAR = 2018;

    public function createTournament() {
        $tournament = new Tournament(SELF::YEAR, new TournamentMVPFinder());

        return $tournament;
    }
}