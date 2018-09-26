<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Team;

class TeamGenerator {

    const NAME = "Cerdos Salvajes";

    public function getTeam() {
        return new Team(self::NAME);
    }
}