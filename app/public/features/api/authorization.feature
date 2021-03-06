Feature: authorizing client application
  In order to make API requests
  As a client application
  I want to be authorized

  Scenario: reject calls from non-authorized clients
    When I make request "GET" "/api/v1/dockedships"
    Then the response status code should be 401

  Scenario Outline: should not get access token on any invalid or empty param
    Given client is created
    When I make request "POST" "/oauth/v2/token" with parameter-bag params:
      | client_id     | <client_id>       |
      | client_secret | <client_secret>   |
      | response_type | <code>            |
      | grant_type    | <grant_type>      |
      | username      | <username>        |
      | password      | <password>        |
    Then the response status code should be 400
    And the response should contain "error"

    Examples:
      | client_id        | client_secret | code | grant_type         | username   | password  |
      | invalid          | CLIENT_SECRET | code | client_credentials |            |           |
      |                  | CLIENT_SECRET | code | client_credentials |            |           |
      | CLIENT_PUBLIC_ID | invalid       | code | client_credentials |            |           |
      | CLIENT_PUBLIC_ID |               | code | client_credentials |            |           |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code | invalid            |            |           |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code |                    |            |           |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code | password           |            |           |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code | password           | admin      |           |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code | password           |            | admin     |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code | password           | invalid    | admin     |
      | CLIENT_PUBLIC_ID | CLIENT_SECRET | code | password           | admin      | invalid   |

  Scenario: successfully get access token
    Given client is created
    When I make request "POST" "/oauth/v2/token" with parameter-bag params:
      | client_id     | CLIENT_PUBLIC_ID    |
      | client_secret | CLIENT_SECRET       |
      | response_type | code                |
      | grant_type    | client_credentials  |
    Then the response status code should be 200
    And the response should contain "access_token"
    And the response should not contain "error"

  Scenario: allow calls from authorized clients
    Given I am authorized client
    When I make request "GET" "/api/v1/dockedships"
    Then the response status code should be 200
