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
            "cd build/tests/phpunit/",
            "phpunit .",
            "cd ".getcwd());
        $this->uninstallCommands = array( );
        $this->registeredPostInstallFunctions = array( );
        $this->programNameMachine = "phpunit"; // command and app dir name
        $this->programNameFriendly = " PHPUnit "; // 12 chars
        $this->programNameInstaller = "PHPUnit";
        $this->programExecutorTargetPath = 'phpunit/bin/phpunit';
        $this->initialize();
    }

}