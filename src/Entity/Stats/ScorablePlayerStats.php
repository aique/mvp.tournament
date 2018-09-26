<?php

namespace App\Entity\Stats;

interface ScorablePlayerStats {

    /**
     * Devuelve los puntos realizados por un jugador para su equipo.
     * @return int
     */
    public function getMatchScore();

    /**
     * Devuelve los puntos realizados por un jugador para ser elegido MVP.
     * @return int
     */
    public function getPlayerScore();
}