<?php

namespace App\Tests\Unit\Utils\Generation;

use App\Entity\Player;

class PlayerGenerator {

    const NAME = "Antonio Prieto";
    const NICKNAME = "aprieto";

    public function getPlayer() {
        return new Player(self::NAME, self::NICKNAME);
    }
}