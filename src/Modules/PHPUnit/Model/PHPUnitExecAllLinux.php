<?php

Namespace Model;

class PHPUnitExecAllLinux extends BaseTestExec {

    // Compatibility
    public $os = array("Linux") ;
    public $linuxType = array("Debian", "Redhat") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("Executor") ;
    private $paramsForBootstrappingModels ;

    public function __construct($params) {
        parent::__construct($params);
        $this->paramsForBootstrappingModels = $params ;
        $this->autopilotDefiner = "PHPUnitExec";
        $this->installCommands = array(
            "mkdir -p build/tests/phpunit/",
            "cd build/tests/phpunit/" );
        $this->uninstallCommands = array(
            "rm -rf build/tests/phpunit/" );
        $this->registeredPostInstallFunctions = array(
            "addTemplatesForFirstFeature",
            "addTemplatesForFirstFeatureContext" );
        $this->programNameMachine = "phpunit"; // command and app dir name
        $this->programNameFriendly = " PHPUnit "; // 12 chars
        $this->programNameInstaller = "PHPUnit";
        $this->programExecutorTargetPath = 'phpunit/bin/phpunit';
        $this->initialize();
    }

    protected function addTemplatesForFirstFeature() {
        $templatorFactory = new \Model\Templating();
        $templator = $templatorFactory->getModel($this->params);
        $originalTemplate = dirname(__FILE__)."/../Templates/first-feature.tpl.php" ;
        $appPath = $this->findPathOfApp() ;
        $targetLocation = $appPath."build/tests/phpunit/features/first.feature" ;
        $templator->template(
            $originalTemplate,
            array(),
            $targetLocation );
    }

    protected function addTemplatesForFirstFeatureContext() {
        $templatorFactory = new \Model\Templating();
        $templator = $templatorFactory->getModel($this->params);
        $originalTemplate = dirname(__FILE__)."/../Templates/FeatureContext.php" ;
        $appPath = $this->findPathOfApp() ;
        $targetLocation = $appPath."build/tests/phpunit/features/bootstrap/FeatureContext.php" ;
        $appUrl = $this->findUrlOfApp() ;
        $replacements = array( 'site_url' => $appUrl ) ;
        $templator->template(
            $originalTemplate,
            $replacements,
            $targetLocation );
    }

    protected function findUrlOfApp() {
        if (isset($this->params["phpunit-target-url"]) && $this->params["phpunit-target-url"] != "") {
            $urlOfApp = $this->params["phpunit-target-url"] ; }
//        else if (isset($this->params["phpunit-environment"]) && $this->params["phpunit-environment"] != "") {
//            $urlOfApp = $this->getUrlFromPapyrus($this->params["phpunit-environment"]) ; }
        return $urlOfApp = (isset($urlOfApp)) ? $urlOfApp : null  ;
    }

    protected function findPathOfApp() {
        if (isset($this->params["phpunit-target-path"]) && $this->params["phpunit-target-path"] != "") {
            $pathOfApp = $this->params["phpunit-target-path"] ; }
//        else if (isset($this->params["phpunit-environment"]) && $this->params["phpunit-environment"] != "") {
//            $pathOfApp = $this->getPathFromPapyrus($this->params["phpunit-environment"]) ; }
        if (isset($pathOfApp)) {
            echo $pathOfApp."\n" ;
            echo substr($pathOfApp, -1, 1)."\n" ;
            if (substr($pathOfApp, -1, 1) != '/') { $pathOfApp .= '/' ; } }
        return (isset($pathOfApp)) ? $pathOfApp : null  ;
    }

//    protected function getUrlFromPapyrus($environment) {
//        return "www.papyrus-url.co.uk" ;
//    }
//
//    protected function getPathFromPapyrus($environment) {
//        return "/var/www/papyrus-output/" ;
//    }

}