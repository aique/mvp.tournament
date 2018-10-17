Feature: Game Stats
  In order to save player stats in a match
  As an organizer
  I need to know the player score

  Scenario Outline:
    Given there is a basketball player in a match
    When he plays as <position> and he scores <points> points, catches <rebounds> rebounds and gives <assists> assists
    Then his game score should be <score>

  Examples:
    | position | points | rebounds | assists | score |
    | C        | 20     | 10       | 2       | 56    |
    | C        | 10     | 20       | 5       | 55    |
    | C        | 5      | 5        | 10      | 45    |
    | F        | 20     | 10       | 2       | 64    |
    | F        | 10     | 20       | 5       | 70    |
    | F        | 5      | 5        | 10      | 40    |
    | G        | 20     | 10       | 2       | 72    |
    | G        | 10     | 20       | 5       | 85    |
    | G        | 5      | 5        | 10      | 35    |

  Scenario Outline:
    Given there is a handball player in a match
    When he plays as <position> and he made <scored> goals and receives <received> goals
    Then his game score should be <score>

    Examples:
      | position | scored | received | score |
      | G        | 0      | 10       | 30    |
      | G        | 5      | 5        | 65    |
      | G        | 10     | 2        | 96    |
      | F        | 0      | 10       | 10    |
      | F        | 5      | 5        | 20    |
      | F        | 10     | 2        | 28    |

  Scenario Outline:
    Given there is a team in a basketball match
    When the team center scores <points1> points, catches <rebounds1> rebounds and gives <assists1> assists
    And the team forward scores <points2> points, catches <rebounds2> rebounds and gives <assists2> assists
    And the team guard scores <points3> points, catches <rebounds3> rebounds and gives <assists3> assists
    Then the team score should be <score> points

    Examples:
      | points1 | rebounds1 | assists1 | points2 | rebounds2 | assists2 | points3 | rebounds3 | assists3 | score |
      | 5       | 5         | 10       | 15      | 10        | 5        | 5       | 0         | 5        | 25    |
      | 10      | 10        | 5        | 10      | 0         | 5        | 0       | 20        | 5        | 20    |
      | 30      | 0         | 2        | 5       | 0         | 10       | 20      | 10        | 0        | 55    |

  Scenario Outline:
    Given there is a team in a handball match
    When the team goalkeeper made <made1> goals and received <received2> goals
    And the team fieldPlayer made <made2> goals and received <received2> goals
    Then the team score should be <score> points

    Examples:
      | made1 | received1 | made2 | received2 | score |
      | 5     | 5         | 10    | 15        | 15    |
      | 10    | 10        | 5     | 10        | 15    |
      | 30    | 0         | 2     | 5         | 32    |
