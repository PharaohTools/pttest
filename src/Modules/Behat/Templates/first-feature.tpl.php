Feature: Your first feature
Lets check out the home page is working

Scenario: Lets check the Home Page works
  Given I start a new session
  And I am on the home page
  Then I should see some text
  Then I end the session