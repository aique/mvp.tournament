<?php

namespace App\Services\Score;

use App\Exceptions\WrongDataFileFormatException;

interface ScorablePlayerStats {

    /**
     * Devuelve los puntos realizados por un jugador para su equipo.
     * @return int
     */
    public function getMatchScore();

    /**
     * TODO: Se ha añadido un throws a este método para tener presente que
     * hay una excepción que ha de ser manejada.
     *
     * Devuelve los puntos realizados por un jugador para ser elegido MVP.
     * @return int
     * @throws WrongDataFileFormatException
     */
    public function getPlayerScore();
}