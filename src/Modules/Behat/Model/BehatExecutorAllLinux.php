<?php

Namespace Model;

class BehatExecutorAllLinux extends BaseTestExec {

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
        $this->autopilotDefiner = "Behat";
        $this->installCommands = array(
            "cd ".getcwd(),
            "cd build/tests/behat/",
            "behat" );
        $this->uninstallCommands = array(  );
        $this->programNameMachine = "behat"; // command and app dir name
        $this->programNameFriendly = " Behat "; // 12 chars
        $this->programNameInstaller = "Behat";
        $this->programExecutorTargetPath = 'behat/bin/behat';
        $this->initialize();
    }

}