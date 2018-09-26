<?php

namespace App\Entity\Stats;

use App\Services\Score\BasketballPlayerScoreService;

class BasketballStats implements GameStats {

    private $position;
    private $points;
    private $rebounds;
    private $assists;

    public function __construct($position, $points, $rebounds, $assists) {
        $this->position = $position;
        $this->points = $points;
        $this->rebounds = $rebounds;
        $this->assists = $assists;
    }

    /**
     * @return mixed
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * @return mixed
     */
    public function getRebounds() {
        return $this->rebounds;
    }

    /**
     * @return mixed
     */
    public function getAssists() {
        return $this->assists;
    }

    public function getScoreService() {
        return new BasketballPlayerScoreService($this);
    }
}