<?php

namespace App\Services;
use App\Entity\Match;
use App\Exceptions\WrongDataFileFormatException;

/**
 * TODO: Se ha eliminado el método estático de esta clase. La clase puede
 * ser renombrada de forma más identificativa con respecto a su funcionalidad
 * principal, por ejemplo MVPFinder/MVPCalculator.
 */
class TournamentStatsService {

    public function getMVP(array $matches) {
        $playerScores = $this->getFinalScores($matches);
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
     * @param array $matches
     * @return array
     */
    private function getFinalScores(array $matches) {
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
            } catch (WrongDataFileFormatException $ex) {
                // TODO tratar la excepción
            }
        }

        return $playerScores;
    }
}