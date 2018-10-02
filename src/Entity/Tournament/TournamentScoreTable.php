<?php

namespace App\Entity\Tournament;

use App\Entity\Match;
use App\Entity\Player;

class TournamentScoreTable {

    const MVP_TEAM_WON_EXTRA_SCORE = 10;

    private $tournamentScoreTable;

    public function __construct(array $matches) {
        $this->tournamentScoreTable = $this->createTournamentScoreTable($matches);
    }

    public function getMvps() {
        $highestScore = 0;
        $mvp = [];

        foreach($this->tournamentScoreTable as $playerNickname => $tournamentScore) {
            $player = $tournamentScore->getPlayer();
            $playerScore = $tournamentScore->getScore();

            if ($playerScore > $highestScore) {
                $highestScore = $playerScore;
                $mvp = [$player];
            } else if ($playerScore == $highestScore) {
                $mvp[] = $player;
            }
        }

        return $mvp;
    }

    private function createTournamentScoreTable(array $matches) {
        $scoreTable = [];

        foreach ($matches as $match) {
            try {
                foreach ($match->getGameStats() as $gameStat) {
                    $player = $gameStat->getPlayer();
                    $playerScore = $gameStat->getPlayerScore();
                    $playerTeamName = $gameStat->getTeam()->getName();

                    $playerScore += $this->getTeamWonExtraScore($match, $playerTeamName);
                    $playerScore = $this->incrementCurrentPlayerScore($scoreTable, $player, $playerScore);
                    $scoreTable = $this->appendMvpScoreToTournamentScores($scoreTable, $player, $playerScore);
                }
            } catch (\Exception $ex) {
                // TODO tratar la excepción
            }
        }

        return $scoreTable;
    }

    private function getTeamWonExtraScore(Match $match, $playerTeamName) {
        if ($this->matchMvpTeamWon($match, $playerTeamName)) {
            return self::MVP_TEAM_WON_EXTRA_SCORE;
        }

        return 0;
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
            $tournamentScore = $tournamentScores[$playerNickname];
            $currentScore = $tournamentScore->getScore();
        }

        return $currentScore;
    }

    private function appendMvpScoreToTournamentScores(array $tournamentScores, Player $player, $score) {
        $tournamentScores[$player->getNickname()] = new TournamentScore($player, $score);

        return $tournamentScores;
    }
}