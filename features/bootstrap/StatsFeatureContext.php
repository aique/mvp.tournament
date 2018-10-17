<?php

use Behat\Behat\Context\Context;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Stats\BasketballStats;
use App\Entity\Stats\GameStats;
use PHPUnit\Framework\Assert;
use App\Entity\Stats\HandballStats;
use App\Entity\Match;
use App\Services\MatchWinnerFinder;

class StatsFeatureContext implements Context {

    /** @var Match */
    private $match;

    /** @var Team */
    private $team;

    /** @var Player */
    private $player;

    /** @var GameStats */
    private $gameStats;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /**
     * @Given there is a basketball player in a match
     */
    public function thereIsABasketballPlayerInAMatch()
    {
        $this->team = new Team("Team A");
        $this->player = new Player("Player A", "playera");
    }

    /**
     * @When he plays as :position and he scores :points points, catches :rebounds rebounds and gives :assists assists
     */
    public function heScoresPointsCatchesReboundsAndGivesAssistsAndHisTeamWinsTheMatch($position, $points, $rebounds, $assists)
    {
        $basketballGameStats = new BasketballStats(
            strval($position),
            $points,
            $rebounds,
            $assists
        );

        $this->gameStats = new GameStats(
            $this->player,
            $this->team,
            $basketballGameStats
        );
    }

    /**
     * @Then his game score should be :playerScore
     */
    public function hisGameScoreShouldBe($playerScore)
    {
        Assert::assertEquals(intval($playerScore), $this->gameStats->getPlayerScore());
    }

    /**
     * @Given there is a handball player in a match
     */
    public function thereIsAHandballPlayerInAMatch()
    {
        $this->team = new Team("Team A");
        $this->player = new Player("Player A", "playera");
    }

    /**
     * @When he plays as :position and he made :scored goals and receives :received goals
     */
    public function hePlaysAsGAndHeMadeGoalsAndReceivesGoals($position, $scored, $received)
    {
        $handballGameStats = new HandballStats(
            strval($position),
            $scored,
            $received
        );

        $this->gameStats = new GameStats(
            $this->player,
            $this->team,
            $handballGameStats
        );
    }

    /**
     * @Given there is a team in a basketball match
     */
    public function thereIsATeamInABasketballMatch()
    {
        $this->match = new Match(new MatchWinnerFinder());
        $this->team = new Team("Team A");
    }

    /**
     * @When the team center scores :points points, catches :rebounds rebounds and gives :assists assists
     */
    public function theTeamCenterScoresPointsCatchesReboundsAndGivesAssists($points, $rebounds, $assists)
    {
        $basketballGameStats = $this->createBasketballGameStats(BasketballStats::CENTER_POSITION, $points, $rebounds, $assists);
        $this->match->addGameStats($basketballGameStats);
    }

    private function createBasketballGameStats($position, $points, $rebounds, $assists) {
        $basketballGameStats = new BasketballStats(
            $position,
            $points,
            $rebounds,
            $assists
        );

        $gameStats = new GameStats(
            new Player ("Player", "player"),
            $this->team,
            $basketballGameStats
        );

        return $gameStats;
    }

    /**
     * @When the team forward scores :points points, catches :rebounds rebounds and gives :assists assists
     */
    public function theTeamForwardTeamMemberScoresPointsCatchesReboundsAndGivesAssists($points, $rebounds, $assists)
    {
        $basketballGameStats = $this->createBasketballGameStats(BasketballStats::FORWARD_POSITION, $points, $rebounds, $assists);
        $this->match->addGameStats($basketballGameStats);
    }

    /**
     * @When the team guard scores :points points, catches :rebounds rebounds and gives :assists assists
     */
    public function theTeamGuardTeamMemberScoresPointsCatchesReboundsAndGivesAssists($points, $rebounds, $assists)
    {
        $basketballGameStats = $this->createBasketballGameStats(BasketballStats::GUARD_POSITION, $points, $rebounds, $assists);
        $this->match->addGameStats($basketballGameStats);
    }

    /**
     * @Then the team score should be :teamScore points
     */
    public function theTeamScoreShouldBePoints($teamScore)
    {
        $generatedTeamScore = 0;

        $gameStats = $this->match->getGameStats();

        foreach ($gameStats as $gameStat) {
            $generatedTeamScore += $gameStat->getTeamScore();
        }

        Assert::assertEquals(intval($teamScore), $generatedTeamScore);
    }

    /**
     * @Given there is a team in a handball match
     */
    public function thereIsATeamInAHandballMatch()
    {
        $this->match = new Match(new MatchWinnerFinder());
        $this->team = new Team("Team A");
    }

    /**
     * @When the team goalkeeper made :goalsMade goals and received :goalsReceived goals
     */
    public function theTeamGoalkeeperMadeGoalsAndReceivedGoals($goalsMade, $goalsReceived)
    {
        $handballGameStats = $this->createHandballGameStats(HandballStats::GOALKEEPER_POSITION, $goalsMade, $goalsReceived);
        $this->match->addGameStats($handballGameStats);
    }

    private function createHandballGameStats($position, $goalsMade, $goalsReceived) {
        $handballGameStats = new HandballStats(
            $position,
            $goalsMade,
            $goalsReceived
        );

        $gameStats = new GameStats(
            new Player ("Player", "player"),
            $this->team,
            $handballGameStats
        );

        return $gameStats;
    }

    /**
     * @When the team fieldPlayer made :goalsMade goals and received :goalsReceived goals
     */
    public function theTeamFieldplayerMadeGoalsAndReceivedGoals($goalsMade, $goalsReceived)
    {
        $handballGameStats = $this->createHandballGameStats(HandballStats::FIELD_PLAYER_POSITION, $goalsMade, $goalsReceived);
        $this->match->addGameStats($handballGameStats);
    }

}