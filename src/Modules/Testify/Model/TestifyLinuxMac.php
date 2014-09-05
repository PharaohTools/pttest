<?php

Namespace Model;

class TestifyLinuxMac extends Base {

    // Compatibility
    public $os = array("any") ;
    public $linuxType = array("any") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("Testifyer") ;

    // test types to be set up in this run
    public $testRequest ; // currently requested group
    private $testTypes ; // all available types

    public function __construct($params) {
        parent::__construct($params);
    }

    public function askWhetherToTestify() {
        if ($this->askToScreenWhetherToTestify() != true) { return false; }
        $this->setAllTestTypes() ;
        $this->doAllTestifies() ;
        return true;
    }

    public function askToScreenWhetherToTestify() {
        if (isset($this->params["yes"])) { return true ; }
        $question = 'Testify This?';
        return self::askYesOrNo($question, true);
    }

    public function setAllTestTypes() {
        $this->testTypes =  array(
            "standard-php" => array ("behat", "PHPUnit") ,
            "joomla" => array ("PHPUnit", "jasmine") ,
            "drupal7" => array ("simpletest", "jasmine") ,
            "php-js" => array ("phpunit", "jasmine") ,
            "html-js" => array ("jasmine")
        );
    }

    private function doAllTestifies() {
        $testTypesToDo = $this->testTypes[$this->testRequest] ;
        foreach ($testTypesToDo as $testType) {
            $this->doSingleTestify($testType) ; }
    }

    private function doSingleTestify($testType) {
        $module = ucfirst($testType) ;
        $cl = '\Model\\'.$module ;
        $testFactory = new $cl() ;
        $test = $testFactory->getModel($this->params) ;
        $test->askInit();
    }

}