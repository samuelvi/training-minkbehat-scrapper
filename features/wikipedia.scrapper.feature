Feature: Scrap behat references from wikipedia
  In order get behat references
  As an anonymous user
  I visit wikipedia behat entry and scrap the references list
  Scenario: Visit the HomePage
    Given I am on "https://www.wikipedia.org"
    Then  I should see "The Free Encyclopedia"
    When  I follow "English"
    Then  the url should match "wiki/Main_Page"
    And   I should see "Welcome to Wikipedia,"
    When  I fill in "Search Wikipedia" with "Behat (computer science)"
    And   I press "Search Wikipedia"
    And   I follow "Behat (computer science)"
    Then  print current URL
    Then  I should see "Behat is intended to aid communication between developers, clients and other stakeholders during a software development process."
    And   I save references in a local storage device
    And   I save references in a local storage device again