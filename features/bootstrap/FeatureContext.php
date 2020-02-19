<?php header('Content-type: text/plain; charset=utf-8');
 
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    
    public function __construct()
    {
    }
    
    /**
    
    * @Then /^I wait for the page to load$/
    
    */
    public function iWaitForThePageToLoad()
    
    {
        $this->getSession()->wait(10000, "document.readyState === 'complete'");
    }
    
    /**
    
    /**
     *
     *
     * @When /^(?:|I )wait for XPATH element "(?P<xpath>(?:[^"]|\\")*) to appear"$/
     */
    public function iWaitForXPathElementToAppear($xpath, $wait = 30)
    {
        $time = time();
        $stopTime = $time + $wait;
        while (time() < $stopTime)
        {
            try {
                if ($this->getSession()->getDriver()->isVisible($xpath)) {
                    return;
                }
            } catch (Exception $e) {
                // do nothing
            }
            
            usleep(250000);
        }
        
        throw new Exception("Element with xpath {$xpath} not found after {$wait} seconds");
    }
    
    public function iWaitForElementToAppear($locator)
    {
        $this->getMink()->getSession()->getDriver()->wait(10, $this->getSession()->getPage()->findField($locator)->isVisible());
    }
    
    
    /**
     * @Then /^I fill in (.*?) with random value as (.*?)(, length (\d+))?( and parts (1|2))?$/
     */
    public function iFillInWithRandomString($selector, $name, $length, $parts){
        $string = RandomVariables::attachRandomStringToArray($name, $length, $parts);
        $field = $this->fixStepArgument($selector);
        $this->getSession()->getPage()->fillField($field, $string);
    }
    
    /**
     * @Then /^I fill in (.*?) with random number as (.*?) in range (.*?)-(.*?)$/
     */
    public function iFillInWithRandomNumber($selector, $name, $min, $max){
        $string = RandomVariables::attachRandomNumberToArray($name, $min, $max);
        $field = $this->fixStepArgument($selector);
        $this->getSession()->getPage()->fillField($field, $string);
    }
    
    /**
     * @Then /^I fill in (.*?) with random email as (.*?)$/
     */
    public function iFillInWithRandomEmail($selector, $name){
        $string = RandomVariables::attachRandomEmailToArray($name);
        $field = $this->fixStepArgument($selector);
        $this->getSession()->getPage()->fillField($field, $string);
    }
    
    
    /**
     * @Then /^I should see text matching entered earlier "([^"]+)"$/
     */
    public function iShouldSeeTextMatchingEnteredEarlier($variableName){
        $string = RandomVariables::getString($variableName);
        $this->assertSession()->pageTextContains($string);
    }
    
    /**
     * @Then /^I should see text "([^"]+)" on page$/
     */
    public function iShouldSeeTextOnPage($string){
        $this->assertSession()->pageTextContains($string);
    }
    
    /**
     * @Then /^I should see tomorrow date on page$/
     */
    public function iShouldSeeTomorrowDateOnPage(){
        $value = date("d/m/Y", strtotime("+1 day"));
        $this->assertSession()->pageTextContains($value);
    }
    
    /**
     * @Then /^I should see date 1 year ahead on page$/
     */
    public function iShouldSeeDateYearAheadOnPage(){
        $value = date("d/m/Y", strtotime("+1 year"));
        $this->assertSession()->pageTextContains($value);
    }

    /**
     * Waits on the page for x seconds
     * Example: And I wait for "duration" seconds
     *
     *
     * @When /^(?:|I )wait for "(?P<duration>(?:[^"]|\\")*)" seconds$/
     */
    public function Wait($duration)
    {
        usleep($duration*1000000);
    }

    /**
     * CLicks element with selected XPATH
     * Example: And I click XPATH element "XPATH"
     *
     *
     * @When /^(?:|I )click XPATH element "(?P<xpath>(?:[^"]|\\")*)"$/
     */
    public function iClickOnTheElementWithXPath($xpath)
    {
        $session = $this->getSession(); // get the mink session
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', $xpath)
        ); // runs the actual query and returns the element

        // errors must not pass silently
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate XPath: "%s"', $xpath));
        }

        // ok, let's click on it
        $element->click();

    }
    

    function fixStepArgument($argument)
    {
        return str_replace('\\"', '"', $argument);
    }
   
}

