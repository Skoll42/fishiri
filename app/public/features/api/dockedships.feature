Feature: getting dockedships through API
  In order to get information about docked ships
  As an authorized client application
  I want to be able to retrieve docked ships list

  Background:
    Given I load "DockedShips" fixtures
    And I am authorized client

  Scenario: get list of all dockedships
    When I make request "GET" "/api/v1/dockedships"
    Then the response status code should be 200
    And the response JSON should be a collection
    And all response collection items should have "id" field

  Scenario: get single docked ship object
    When I make request "GET" "/api/v1/dockedships/{DockedShipsFixtures_1}"
    Then the response status code should be 200
    And the response JSON should be a single object
    And the repsonse JSON should have "id" field with value "{DockedShipsFixtures_1}"