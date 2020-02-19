Feature: Pluto

  Background:

    @javascript
    Scenario: Check Values on cover details page: Annual - tomorrow - without partner- last minute - standard
      Given I am on "tailored-annual-or-single"
      And I wait for the page to load
      When I choose annual cover
      And I choose Worldwide including USA
      And I choose cover start Tomorrow
      And I choose Dont add partner to cover
      And I proceed to next stage
      And I fill random username
      And I fill random age
      And I choose I don't have pre-existing medical conditions
      And I proceed to next stage
      And I choose Last minute special
      And I choose Pluto Standard Annual cover
      And I choose Add all optional extras
      And I proceed to next stage
      Then I should see text matching entered earlier "username"
	  And I should see text matching entered earlier "Age"
	  And I should see text "£129" on page
	  And I should see text "£10m" on page
	  And I should see text "£500" on page
	  And I should see text "£25,000" on page
	  And I should see text "£2m" on page
	  And I should see text "2 devices" on page
	  And I should see text "£1,500" on page
	  And I should see text "£250" on page
	  And I should see text "£100" on page
	  And I should see text "£1,500" on page
	  And I should see text "£20 per 12hrs" on page
	  And I should see text "45" on page
	  And I should see text "30 days max" on page
	  And I should see text "Annual cover" on page
	  And I should see text "Worldwide incl USA, Canada & Caribbean" on page
	  And I should see tomorrow date on page
	  And I should see date 1 year ahead on page
	   
	@javascript
    Scenario: Fill improper random age and check if the message appears
      Given I am on "tailored-annual-or-single"
      And I wait for the page to load
      When I choose annual cover
      And I choose Worldwide including USA
      And I choose cover start Tomorrow
      And I choose Dont add partner to cover
      And I proceed to next stage
      And I fill improper random age
      Then I should see text "Unfortunately we can only provide insurance to people aged 18 - 46" on page
      
    @javascript
    Scenario: Send email with quote and check the confirmation
      Given I am on "tailored-annual-or-single"
      And I wait for the page to load
      When I choose annual cover
      And I choose Worldwide including USA
      And I choose cover start Tomorrow
      And I choose Dont add partner to cover
      And I proceed to next stage
      And I fill random username
      And I fill random age
      And I choose I don't have pre-existing medical conditions
      And I proceed to next stage
      And I choose Last minute special
      And I choose Pluto Standard Annual cover
      And I choose Add all optional extras
      And I proceed to next stage
      And I choose "click here to email your quote"
      And I fill in random email
      And I submit "Email me my quote"
      Then I should see text "All done" on page
      And I should see text "We’ve sent your quote via email. Check your spam folder if you can’t find it!" on page
      