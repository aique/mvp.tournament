<?php

namespace App\Services;
use App\Entity\Match;
use App\Entity\Player;
use App\Entity\Stats\PlayerStats;
use App\Exceptions\WrongDataFileFormatException;

class TournamentMVPFinder {

    const MVP_TEAM_WON_EXTRA_SCORE = 10;

    public function getMVPs(array $matches) {
        $playerScores = $this->getTournamentScores($matches);
        $highestScore = 0;
        $mvp = [];

        foreach($playerScores as $player => $score) { // TODO añadir semántica para dar significado al algoritmo
            if ($score > $highestScore) {
                $highestScore = $score;
                $mvp = [$player];
            }else if ($score == $highestScore) {
                $mvp[] = $player;
            }
        }

        return $mvp;
    }

    /**
     * Se crea la tabla de puntuaciones de toda la temporada,
     * añadiendo la puntuación adicional por partido ganado.
     *
     * @param array $matches
     * @return array
     */
    private function getTournamentScores(array $matches) { // TODO crear una entidad TournamentScores?
        $tournamentScores = [];

        /** @var Match $match */
        foreach ($matches as $match) {
            try {
                $matchMvpPlayerStat = $match->getHighestPlayerStat();

                if ($matchMvpPlayerStat == null) {
                    continue;
                }

                $mvpPlayer = $matchMvpPlayerStat->getPlayer();

                $mvpScore = $this->addTeamWonExtraScoreIfNeeded($match, $matchMvpPlayerStat);
                $mvpScore = $this->incrementCurrentPlayerScore($tournamentScores, $mvpPlayer, $mvpScore);
                $tournamentScores = $this->appendMvpScoreToTournamentScores($tournamentScores, $mvpPlayer, $mvpScore);
            } catch (WrongDataFileFormatException $ex) {
                // TODO tratar la excepción
            }
        }

        return $tournamentScores;
    }

    /**
     * @param Match $match
     * @param PlayerStats $matchMvpPlayerStat
     * @return float|int
     * @throws WrongDataFileFormatException
     */
    private function addTeamWonExtraScoreIfNeeded(Match $match, PlayerStats $matchMvpPlayerStat) {
        $playerScore = $matchMvpPlayerStat->getPlayerScore();

        $matchMvpTeamName = $matchMvpPlayerStat->getTeam()->getName();

        if ($this->matchMvpTeamWon($match, $matchMvpTeamName)) {
            $playerScore += self::MVP_TEAM_WON_EXTRA_SCORE;
        }

        return $playerScore;
    }

    private function matchMvpTeamWon(Match $match, $mvpTeamName) {
        return $match->getWinner() != null && strcmp($match->getWinner()->getName(), $mvpTeamName) == 0;
    }

    private function incrementCurrentPlayerScore(array $tournamentScores, Player $player, $newPlayerScore) {
        $matchMvpNickname = $player->getNickname();
        $currentScore = $this->getCurrentPlayerTournamentScore($matchMvpNickname, $tournamentScores);

        return $currentScore + $newPlayerScore;
    }

    private function getCurrentPlayerTournamentScore($playerNickname, array $tournamentScores) {
        $currentScore = 0;

        if (array_key_exists($playerNickname, $tournamentScores)) {
            $currentScore = $tournamentScores[$playerNickname];
        }
        
        return $currentScore;
    }

    private function appendMvpScoreToTournamentScores(array $tournamentScores, Player $player, $score) {
        $tournamentScores[$player->getNickname()] = $score;

        return $tournamentScores;
    }
}