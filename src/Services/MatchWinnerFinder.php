<?php

namespace App\Services;

use App\Entity\Team;
use App\Exceptions\InvalidMatchTeamsException;

class MatchWinnerFinder {

    /**
     * @param array $gameStats
     * @return null
     * @throws InvalidMatchTeamsException
     */
    public function getWinner(array $gameStats) {
        $team1 = $team2 = null;
        $this->initTeams($gameStats, $team1, $team2);

        $team1Score = $team2Score = 0;

        foreach ($gameStats as $gameStats) {
            $currentTeamName = $gameStats->getTeam()->getName();
            $currentTeamScore = $gameStats->getTeamScore();

            if ($this->teamNameMatch($team1, $currentTeamName)) {
                $team1Score += $currentTeamScore;
            } else {
                $team2Score += $currentTeamScore;
            }
        }

        return $team1Score > $team2Score ? $team1 : $team2;
    }

    private function initTeams($gameStats, &$team1, &$team2) {
        $teamsInitialized = false;

        foreach ($gameStats as $gameStats) {
            $currentTeam = $gameStats->getTeam();
            $currentTeamName = $currentTeam->getName();

            if ($this->teamIsUnknown($team1)) {
                $team1 = $currentTeam;
            } elseif ($this->teamIsUnknown($team2) && !$this->teamNameMatch($team1, $currentTeamName)) {
                $team2 = $currentTeam;
            }

            if ($this->teamsInitialized($team1, $team2)) {
                $teamsInitialized = true;
                break;
            }
        }

        if (!$teamsInitialized) {
            throw new InvalidMatchTeamsException();
        }
    }

    private function teamsInitialized($team1, $team2) {
        return $team1 != null && $team2 != null;
    }

    private function teamIsUnknown($team) {
        return $team == null;
    }

    private function teamNameMatch(Team $team1, $team2Name) {
        return strcmp($team1->getName(), $team2Name) == 0;
    }
}