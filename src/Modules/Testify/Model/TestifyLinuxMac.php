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
        $question = 'Testify This?';
        return self::askYesOrNo($question, true);
    }

    public function setAllTestTypes() {
        $this->testTypes =  array(
            "standard-php" => array ("behat", "phpunit") ,
            "joomla" => array ("phpunit", "jasmine") ,
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
        $singleTestModel = "" ;
        $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $this->content) ;
        // if we don't have an object, its an array of errors
        // if (is_array($thisModel)) { return $this->failDependencies($pageVars, $this->content, $thisModel) ; }
    }

}