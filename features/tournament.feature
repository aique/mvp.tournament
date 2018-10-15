Feature: Tournament
  In order to give an award
  As a organizer
  I need to get the most valuable players

  Scenario: Requesting a most valuable players list
    Given there is a tournament
    When I add 1 match to the tournament, which has 2 or more players
    Then I should have 1 match in the tournament
    And I should have 1 o more players as the most valuable ones