Feature: getting riggdata through API
  In order to get information about riggdata
  As an authorized client application
  I want to be able to retrieve riggdata list

  Background:
    Given I load "RiggData" fixtures
    And I am authorized client

  Scenario: get list of all riggdata
    When I make request "GET" "/api/v1/riggdata"
    Then the response status code should be 200
    And the response JSON should be a collection
    And all response collection items should have "id" field

  Scenario: get single riggdata object
    When I make request "GET" "/api/v1/riggdata/{RiggDataFixtures_1}"
    Then the response status code should be 200
    And the response JSON should be a single object
    And the repsonse JSON should have "id" field with value "{RiggDataFixtures_1}"