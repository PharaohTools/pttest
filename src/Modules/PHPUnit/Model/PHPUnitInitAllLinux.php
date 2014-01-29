<?php

Namespace Model;

class PHPUnitInitAllLinux extends BaseTestInit {

    // Compatibility
    public $os = array("Linux") ;
    public $linuxType = array("Debian", "Redhat") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("Initializer") ;
    private $paramsForBootstrappingModels ;

    public function __construct($params) {
        parent::__construct($params);
        $this->paramsForBootstrappingModels = $params ;
        $this->autopilotDefiner = "PHPUnitInit";
        $this->installCommands = array(
            "mkdir -p build/tests/phpunit/",
            "mkdir -p build/config/phpunit/",
            "cd build/tests/phpunit/" );
        $this->uninstallCommands = array(
            "rm -rf build/tests/phpunit/",
            "rm -rf build/config/phpunit/" );
        $this->registeredPostInstallFunctions = array(
            "addTemplates" );
        $this->programNameMachine = "phpunit"; // command and app dir name
        $this->programNameFriendly = " PHPUnit "; // 12 chars
        $this->programNameInstaller = "PHPUnit";
        $this->programExecutorTargetPath = 'phpunit/bin/phpunit';
        $this->initialize();
    }

    protected function addTemplates
    () {
        $templatorFactory = new \Model\Templating();
        $templator = $templatorFactory->getModel($this->params);
        $appPath = $this->findPathOfApp() ;
        $originalTemplate = dirname(__FILE__)."/../Templates/tests/BaseTest.php" ;
        $targetLocation = $appPath."build/tests/phpunit/BaseTest.php" ;
        $templator->template( $originalTemplate, array(), $targetLocation );
        $targetLocation = $appPath."build/tests/phpunit/bootstrap.php" ;
        $originalTemplate = dirname(__FILE__)."/../Templates/tests/bootstrap.php" ;
        $templator->template( $originalTemplate, array(), $targetLocation );
    }

    /*
     * @todo put this in superclass and use some variable ie $this->programNameMachine to specify which child we're targetting
     */
    protected function findUrlOfApp() {
        if (isset($this->params["phpunit-target-url"]) && $this->params["phpunit-target-url"] != "") {
            $urlOfApp = $this->params["phpunit-target-url"] ; }
        return $urlOfApp = (isset($urlOfApp)) ? $urlOfApp : null  ;
    }

    /*
     * @todo put this in superclass and use some variable ie $this->programNameMachine to specify which child we're targetting
     */
    protected function findPathOfApp() {
        if (isset($this->params["phpunit-target-path"]) && $this->params["phpunit-target-path"] != "") {
            $pathOfApp = $this->params["phpunit-target-path"] ; }
        if (isset($pathOfApp)) {
            echo $pathOfApp."\n" ;
            echo substr($pathOfApp, -1, 1)."\n" ;
            if (substr($pathOfApp, -1, 1) != '/') { $pathOfApp .= '/' ; } }
        return (isset($pathOfApp)) ? $pathOfApp : null  ;
    }

}