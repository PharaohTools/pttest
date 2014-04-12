<?php

use Behat\Behat\Context\ContextInterface;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Behat context class.
 */
class FeatureContext extends MinkContext implements ContextInterface
{

    protected $session ;

    /**
     * Initializes context. Every scenario gets it's own context object.
     *
     * @param array $parameters Suite parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
    }

    /**
     * @Given /^I start a new session$/
     */
    public function iStartANewSession()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();
    }

    /**
     * @Given /^I am on the home page$/
     */
    public function iAmOnTheHomePage()
    {
        $this->session->start();
        $this->session->visit('<%tpl.php%>site_url</%tpl.php%>');
        echo $this->session->getCurrentUrl()."\n";
    }

    /**
     * @Then /^I should see some text$/
     */
    public function iShouldSeeSomeText()
    {
//        $client = new \Selenium\Client($host, $port);
//        $driver = new \Behat\Mink\Driver\SeleniumDriver(
//            'firefox', 'base_url', $client
//        );
    }


    /**
     * @Given /^I end the session$/
     */
    public function iEndTheSession()
    {
        $this->session->stop() ;
    }
}