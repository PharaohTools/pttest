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
        $startDir = getcwd();

//        if () {
//
//        } else {
//
//        }

        $ray = array(
            "cd $featureDir",
            "behat --format $outType --out $outDir",
            "cd $startDir" );
        return $ray ;
    }

    private function getFeatureDir() {
        if (isset($this->params["test-dir"])) { $fDir = $this->params["test-dir"] ; }
        else if (isset($this->params["guess"])) {
            $fDir = "build".DS."tests".DS."behat" ;
            if (!is_dir(getcwd().DS.$fDir)) { mkdir(getcwd().DS.$fDir, 0775, true) ; } }
        else { $fDir = "" ;   }
        return $fDir ;
    }

    private function getOutDir() {
        if (isset($this->params["out-dir"])) {
            // if relative use it or use temp
            if (substr($this->params["out-dir"], 0, 1) !== DS) {
                $oDir = ",".$this->params["out-dir"] ; }
            else {
                $this->useTempDir = $this->params["out-dir"] ;
                $oDir = ","."temp" ; } }
        else if (isset($this->params["guess"])) {
            $dir = "..".DS."..".DS."..".DS."build".DS."reports".DS."behat" ;
            $this->useTempDir = $dir ;
            $oDir = ","."temp" ; }
        else { $oDir = ","."reports" ;   }
        return $oDir ;
    }

    private function getOutType() {
        if (isset($this->params["output-type"])) { $oType = $this->params["output-type"] ; }
        else { $oType = "pretty,html" ;   }
        return $oType ;
    }

}