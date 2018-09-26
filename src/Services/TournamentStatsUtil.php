<?php

namespace App\Services;

class TournamentStatsUtil {

    public static function getMVP($matches) {
        $playerScores = self::getFinalScores($matches);
        $highestScore = 0;
        $mvp = null;

        foreach($playerScores as $player => $score) {
            if ($score > $highestScore) {
                $highestScore = $score;
                $mvp = $player;
            }
        }

        return $mvp;
    }

    /**
     * Se crea la tabla de puntuaciones definitiva, añadiendo la puntuación adicional por partido ganado.
     * @param $matches
     * @return array
     */
    private static function getFinalScores($matches) {
        $playerScores = [];

        /** @var Match $match */
        foreach ($matches as $match) {
            try {
                $highestPlayerStat = $match->getHighestPlayerStat();

                if (strcmp($match->getWinner()->getName(), $highestPlayerStat->getTeam()->getName()) == 0) {
                    $playerScore = $highestPlayerStat->getPlayerScore() + 10;
                }

                if (array_key_exists($highestPlayerStat->getPlayer()->getNickname(), $playerScores)) {
                    $playerScores[$highestPlayerStat->getPlayer()->getNickname()] += $playerScore;
                } else {
                    $playerScores[$highestPlayerStat->getPlayer()->getNickname()] = $playerScore;
                }
            } catch (WrongDataFileFormatException $ex) {}
        }

        return $playerScores;
    }
}