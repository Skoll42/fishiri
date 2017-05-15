Feature: getting feltdata through API
  In order to get information about feltdata
  As an authorized client application
  I want to be able to retrieve feltdata list

  Background:
    Given I load "FeltData" fixtures
    And I am authorized client

  Scenario: get list of all feltdata
    When I make request "GET" "/api/v1/feltdata"
    Then the response status code should be 200
    And the response JSON should be a collection
    And all response collection items should have "id" field

  Scenario: get single feltdata object
    When I make request "GET" "/api/v1/feltdata/{FeltDataFixtures_1}"
    Then the response status code should be 200
    And the response JSON should be a single object
    And the repsonse JSON should have "id" field with value "{FeltDataFixtures_1}"