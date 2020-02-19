<?php

    
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\Context;

class PageContext extends RawMinkContext implements Context{
    
    private $subContext;
    /**
     * @BeforeScenario
     */
    public function beforeScenario(Behat\Behat\Hook\Scope\BeforeScenarioScope $scope)
    {
//         $this->getSession()->getDriver()->resizeWindow(1060, 450);
        $environment = $scope->getEnvironment();
        $this->subContext = $environment->getContext('FeatureContext');
    }
    
	/**
	
	* @Then /^I choose annual cover$/
	
	*/
	public function iChooseAnnualCover()
	
	{
	    $this->subContext->iClickOnTheElementWithXPath("//button");
	}
	
	/**
	
	* @When /^I choose Worldwide including USA$/
	
	*/
	public function iChooseWorldwideIncludingUSA()
	
	{
	    $this->subContext->iWaitForXPathElementToAppear("//h3[contains(.,'Some details about your trip')]");
	    $this->subContext->iClickOnTheElementWithXPath("//input");
	}
	
	/**
	
	* @When /^I choose cover start Tomorrow$/
	
	*/
	public function iChooseCoverStartTomorrow()
	
	{
	    $this->subContext->iClickOnTheElementWithXPath("//input[@id='start-date']");
	    $tomorrow_day = date("d", strtotime("+1 day"));
	    $locator = "//span[contains(.,$tomorrow_day)]";
	    $this->subContext->iClickOnTheElementWithXPath($locator);
	    
	}
	
	/**
	
	* @When /^I choose Dont add partner to cover$/
	
	*/
	public function iChooseDontAddPartnerToCover()
	
	{
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='coverQuantity']");
	}
	
	
	/**
	
	* @When /^I proceed to next stage$/
	
	*/
	public function iProceedToNextStage()
	
	{
	    $this->subContext->iWaitForXPathElementToAppear("(//button[contains(.,'Next')])[1]");
	    $this->subContext->iClickOnTheElementWithXPath("(//button[contains(.,'Next')])[1]");
	    $this->subContext->iWaitForThePageToLoad();
	    usleep(3000000);
	}
	
	/**
	
	* @When /^I fill random username$/
	
	*/
	public function iFillRandomUsername(){
	    $this->subContext->iWaitForElementToAppear("username");
	    $this->subContext->iFillInWithRandomString("username","username",8,2);
	}
	
	/**
	
	* @When /^I fill random age$/
	
	*/
	public function iFillRandomAge()
	
	{
	    $this->subContext->iFillInWithRandomNumber("age","Age", 18, 46);
	}
	
	/**
	
	* @When /^I fill improper random age$/
	
	*/
	public function iFillImproperRandomAge()
	
	{
	    $this->subContext->iFillInWithRandomNumber("age","Age", 48, 120);
	    $this->subContext->iClickOnTheElementWithXPath("//input[@type='text']");
	}
	
	/**
	
	* @When /^I choose I don't have pre-existing medical conditions$/
	
	*/
	public function iChooseDontHavePreExistingMedicalConditions()
	
	{
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='medical']");
	}
	
	/**
	
	* @When /^I choose Last minute special$/
	
	*/
	public function iChooseLastMinuteSpecial()
	
	{
	    try {
	        $this->subContext->iWaitForXPathElementToAppear("//h3[contains(.,'Building your policy')]", 8);
	        $this->subContext->iClickOnTheElementWithXPath("//a[contains(.,'about to board the plane and I need cover super quick')]");
	    } catch (Exception $e) {
	        $this->subContext->iWaitForXPathElementToAppear("//h1[contains(.,'Two ways to get a quote')]", 8);
	        $this->subContext->iClickOnTheElementWithXPath("//div[2]/div/button/span/span[2]");
	    }
	    
	}
	
	/**
	
	* @When /^I choose Pluto Standard Annual cover$/
	
	*/
	public function iChoosePlutoStandardAnnualCover()
	
	{
	    $this->subContext->iWaitForXPathElementToAppear("//div[2]/div[2]/div/button");
	    $this->subContext->iClickOnTheElementWithXPath("//div[2]/div[2]/div/button");
	}
	
	/**
	
	* @When /^I choose Add all optional extras$/
	
	*/
	public function iChooseAddAllOptionalExtras()
	
	{
	    $this->subContext->iWaitForXPathElementToAppear("//h3[contains(.,'Optional extras')]", 8);
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='winter']");
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='activities']");
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='terrorismCatastrophe']");
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='businessTrip']");
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='removeExcess']");
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='gadget2']");
	}
	
	/**
	
	* @When /^I choose "click here to email your quote"$/
	
	*/
	public function iChooseClickHereToEmailYourQuote()
	
	{
	    $this->subContext->iWaitForXPathElementToAppear("//a[contains(text(),'Not ready to buy? Click here to email your quote')]");
	    $this->subContext->iClickOnTheElementWithXPath("//a[contains(text(),'Not ready to buy? Click here to email your quote')]");
	}
	
	/**
	
	* @When /^I fill in random email$/
	
	*/
	public function iFillInRandomEmail()
	
	{
	    $this->subContext->iWaitForXPathElementToAppear("//h3[contains(.,'Email me my quote')]");
	    $this->subContext->iFillInWithRandomEmail("email", "email");
	}
	
	/**
	
	* @When /^I submit "Email me my quote"$/
	
	*/
	public function iSubmitEmailMeMyQuote()
	
	{
	    $this->subContext->iClickOnTheElementWithXPath("//input[@name='countMe']");
	    $this->subContext->iClickOnTheElementWithXPath("//button[contains(.,'Email me my quote')]");
	    $this->subContext->iWaitForXPathElementToAppear("//p[contains(.,'All done')]", 5);
	}
	
}