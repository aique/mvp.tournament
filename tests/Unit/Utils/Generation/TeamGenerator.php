<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Team;

class TeamGenerator {

    const TEAM_1 = 1;
    const TEAM_2 = 2;

    const NAME_TEAM_1 = "Cerdos Salvajes";
    const NAME_TEAM_2 = "Ranas Saltarinas";

    private $teams;

    public function __construct() {
        $this->teams = [
            new Team(self::NAME_TEAM_1),
            new Team(self::NAME_TEAM_2)
        ];
    }

    public function getTeam($index) {
        assert(is_numeric($index) && $index > 0);

        if (isset($this->teams[$index - 1])) {
            return $this->teams[$index - 1];
        }

        return null;
    }
}