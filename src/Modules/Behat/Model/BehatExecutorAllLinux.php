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
        $this->installCommands = $this->getInstallCommands();
        $this->uninstallCommands = array(  );
        $this->programNameMachine = "behat"; // command and app dir name
        $this->programNameFriendly = "   Behat!   "; // 12 chars
        $this->programNameInstaller = "Behat";
        $this->programExecutorTargetPath = 'behat/bin/behat';
        $this->initialize();
    }

    private function getInstallCommands() {
        $featureDir = $this->getFeatureDir() ;
        $outDir = $this->getOutDir() ;
        $outType = $this->getOutType() ;
        $ray = array(
            "cd ".getcwd(),
            "cd $featureDir",
            "behat --format $outType --out $outDir" );
        return $ray ;
    }

    private function getFeatureDir() {
        if (isset($this->params["test-dir"])) { $fDir = $this->params["test-dir"] ; }
        else { $fDir = "build/tests/behat" ;   }
        return $fDir ;
    }

    private function getOutDir() {
        if (isset($this->params["out-dir"])) { $oDir = $this->params["out-dir"] ; }
        else { $oDir = ",build/reports/behat" ;   }
        return $oDir ;
    }

    private function getOutType() {
        if (isset($this->params["output-type"])) { $oType = $this->params["output-type"] ; }
        else { $oType = "pretty,html" ;   }
        return $oType ;
    }

}