<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Tournament\Tournament;

class TournamentGenerator {

    const YEAR = 2018;

    public function createTournament() {
        $tournament = new Tournament(SELF::YEAR);

        return $tournament;
    }
}