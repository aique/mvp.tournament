<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Player;

class PlayerGenerator {

    const PLAYER_1 = 1;
    const PLAYER_2 = 2;
    const PLAYER_3 = 3;
    const PLAYER_4 = 4;

    const NAME_PLAYER_1 = "Antonio Prieto";
    const NICKNAME_PLAYER_1 = "aprieto";

    const NAME_PLAYER_2 = "Manuel Vidal";
    const NICKNAME_PLAYER_2 = "mvidal";

    const NAME_PLAYER_3 = "Ana Lopez";
    const NICKNAME_PLAYER_3 = "alopez";

    const NAME_PLAYER_4 = "Alicia Solís";
    const NICKNAME_PLAYER_4 = "asolis";

    private $players;

    public function __construct() {
        $this->players = [
            new Player(self::NAME_PLAYER_1, self::NICKNAME_PLAYER_1),
            new Player(self::NAME_PLAYER_2, self::NICKNAME_PLAYER_2),
            new Player(self::NAME_PLAYER_3, self::NICKNAME_PLAYER_3),
            new Player(self::NAME_PLAYER_4, self::NICKNAME_PLAYER_4),
        ];
    }

    public function getPlayer($index) {
        assert(is_numeric($index) && $index > 0);

        if (isset($this->players[$index - 1])) {
            return $this->players[$index - 1];
        }

        return null;
    }
}