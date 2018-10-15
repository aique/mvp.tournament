<?php

use App\Entity\Match;
use App\Entity\Tournament\Tournament;
use App\Tests\Unit\Utils\Generation\BasketballStatsGenerator;
use App\Tests\Unit\Utils\Generation\GameStatsGenerator;
use App\Tests\Unit\Utils\Generation\MatchGenerator;
use App\Tests\Unit\Utils\Generation\PlayerGenerator;
use App\Tests\Unit\Utils\Generation\PlayerStatsGenerator;
use App\Tests\Unit\Utils\Generation\TeamGenerator;
use App\Tests\Unit\Utils\Generation\TournamentGenerator;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Tournament
     */
    private $tournament;
    /**
     * @var Match
     */
    private $match;

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
     * @Given there is a tournament
     */
    public function thereIsATournament()
    {
        $tournamentGenerator = new TournamentGenerator();
        $this->tournament = $tournamentGenerator->createTournament();
    }

    /**
     * @When I add :numMatches match to the tournament, which has :minPlayers or more players
     */
    public function iRequestTheMvpList($numMatches, $minPlayers)
    {
        $matchGenerator = $this->createMatchGenerator();
        $this->match = $matchGenerator->getTwoPlayerStatsMatch([
            GameStatsGenerator::STATS_RANK_1,
            GameStatsGenerator::STATS_RANK_2,
        ]);

        Assert::assertGreaterThanOrEqual(intval($minPlayers), count($this->match->getGameStats()));

        $this->tournament->setMatches([$this->match]);

        Assert::assertCount(intval($numMatches), $this->tournament->getMatches());
    }

    private function createMatchGenerator() {
        $playerGenerator = new PlayerGenerator();
        $teamGenerator = new TeamGenerator();
        $basketballStatsGenerator = new BasketballStatsGenerator();

        $playerStatsGenerator = new PlayerStatsGenerator(
            $playerGenerator,
            $teamGenerator,
            $basketballStatsGenerator
        );

        return new MatchGenerator($playerStatsGenerator);
    }

    /**
     * @Then I should have :count match in the tournament
     */
    public function iShouldHaveOneMatchInTheTournament($count)
    {
        Assert::assertCount(intval($count), $this->tournament->getMatches());
    }

    /**
     * @Then I should have :count o more players as the most valuable ones
     */
    public function iShouldHaveOneOMorePlayersAsTheMostValuableOnes($count)
    {
        Assert::assertGreaterThanOrEqual(intval($count), count($this->tournament->getMVPs()));
    }

}
