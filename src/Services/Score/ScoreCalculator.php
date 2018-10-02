<?php

namespace App\Services\Score;

use App\Exceptions\InvalidStatsValuesException;

interface ScoreCalculator {

    /**
     * Devuelve los puntos realizados por un jugador para su equipo.
     * @return int
     */
    public function getTeamScore();

    /**
     * Devuelve los puntos realizados por un jugador para ser elegido MVP.
     * @return int
     * @throws InvalidStatsValuesException
     */
    public function getPlayerScore();
}