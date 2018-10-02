<?php

namespace App\Entity\Tournament;

use App\Entity\Player;

class TournamentScore {

    private $player;
    private $score;

    public function __construct(Player $player, $score) {
        $this->player = $player;
        $this->score = $score;
    }

    public function getPlayer() {
        return $this->player;
    }

    public function getScore() {
        return $this->score;
    }
}