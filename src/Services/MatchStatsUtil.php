<?php

namespace App\Services;

use App\Entity\Team;

/**
 * Servicio que determina el equipo ganador en función de las estadísticas de un partido.
 */
class MatchStatsUtil {

    /**
     * @param array $stats
     * @return Team
     */
    public static function getWinner($stats) {
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
            }

            if ($team1 != null && $team2 == null && strcmp($team1->getName(), $team->getName()) != 0) {
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
}