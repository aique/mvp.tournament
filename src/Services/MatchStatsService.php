<?php

namespace App\Services;

use App\Entity\Stats\PlayerStats;
use App\Entity\Team;
use App\Exceptions\WrongDataFileFormatException;

/**
 * TODO: Se han eliminado los métodos estáticos de esta clase. Se puede separar esta clase
 * en dos servicios más sencillos, con unos nombres más identificativos.
 *
 * Servicio que determina el equipo ganador en función de las estadísticas de un partido.
 */
class MatchStatsService {

    /**
     * @param array $stats
     * @return Team|null
     */
    public function getWinner(array $stats) {
        /** @var Team $team1 */
        /** @var Team $team2 */
        $team1 = $team2 = null;
        $team1Score = $team2Score = 0;
        /** @var PlayerStats $stat */
        foreach ($stats as $stat) {
            /** @var Team $team */
            $team = $stat->getTeam();

            if ($team1 == null) {
                $team1 = $team;
            } elseif ($team2 == null && strcmp($team1->getName(), $team->getName()) != 0) { // TODO: añadido un elseif tras la revisión
                $team2 = $team;
            }

            if (strcmp($team1->getName(), $team->getName()) == 0) {
                $team1Score += $stat->getMatchScore();
            } else {
                $team2Score += $stat->getMatchScore();
            }
        }

        return $team1Score > $team2Score ? $team1 : $team2;
    }

    /**
     * @param array $stats
     * @return PlayerStats|null
     */
    public function getHighestPlayerStat(array $stats) {
        $highestPlayerScore = 0;
        $highestPlayerStat = null;

        /** @var PlayerStats $currentStat */
        foreach ($stats as $currentStat) {
            try {
                $currentPlayerScore = $currentStat->getPlayerScore();
            } catch (WrongDataFileFormatException $ex) {
                // TODO manejar la excepción adecuadamente
            }

            if ($currentPlayerScore > $highestPlayerScore) {
                $highestPlayerScore = $currentPlayerScore;
                $highestPlayerStat = $currentStat;
            }
        }

        return $highestPlayerStat;
    }
}