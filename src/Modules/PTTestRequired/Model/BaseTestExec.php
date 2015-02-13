<?php

Namespace Model;

class BaseTestExec extends Base {

  protected $installCommands;
  protected $uninstallCommands;
  protected $installUserName;
  protected $installUserHomeDir;
  protected $programExecutorCommand;

  public function __construct($params) {
    parent::__construct($params);
    $this->populateCompletion();
  }

  public function initialize() {
    $this->populateTitle();
  }

  public function askExec() {
    return $this->askWhetherToExecuteTestExec();
  }

  public function askWhetherToExecuteTestExec() {
    return $this->performTestExecExecute();
  }

  public function askUnExec() {
    return $this->askWhetherToUnExecuteTestExec();
  }

  public function askWhetherToUnExecuteTestExec() {
    return $this->performTestExecUnExecute();
  }

  private function performTestExecExecute() {
    $doExecute = (isset($this->params["yes"]) && $this->params["yes"]==true) ?
      true : $this->askWhetherToExecuteTestExecToScreen();
    if (!$doExecute) { return false; }
    return $this->install();
  }

  private function performTestExecUnExecute() {
    $doUnExecute = (isset($this->params["yes"]) && $this->params["yes"]==true) ?
      true : $this->askWhetherToUnExecuteTestExecToScreen();
    if (!$doUnExecute) { return false; }
    return $this->unInstall();
  }

  public function install() {
    $this->showTitle();
    $this->executePreInstallFunctions();
    $this->doExecCommand();
    $this->executePostInstallFunctions();
    if ($this->programDataFolder) {
      $this->changePermissions($this->programDataFolder); }
    $this->extraCommands();
    $this->showCompletion();
    return true;
  }

  public function unInstall() {
    $this->showTitle();
    $this->executePreUnInstallFunctions();
    $this->doUnExecCommand();
    $this->executePostUninstallFunctions();
    $this->extraCommands();
    $this->showCompletion();
    return true;
  }

  private function showTitle() {
    print $this->titleData ;
  }

  private function showCompletion() {
    print $this->completionData ;
  }

  private function askWhetherToExecuteTestExecToScreen(){
    $question = "Execute ".$this->programNameInstaller."?";
    return self::askYesOrNo($question);
  }

  private function askWhetherToUnExecuteTestExecToScreen(){
    $question = "Remove ".$this->programNameInstaller."?";
    return self::askYesOrNo($question);
  }

  protected function askForExecuteUserName(){
      $question = "Enter User To Execute As:";
      $input = (isset($this->params["execute-user-name"])) ? $this->params["execute-user-name"] : self::askForInput($question);
      $this->executeUserName = $input;
  }

  private function doExecCommand(){
    self::swapCommandArrayPlaceHolders($this->installCommands);
    self::executeAsShell($this->installCommands);
  }

  private function doUnExecCommand(){
    self::swapCommandArrayPlaceHolders($this->uninstallCommands);
    self::executeAsShell($this->uninstallCommands);
  }

  private function changePermissions($target=null){
    if ($target != null) {
      $command = "chmod -R 775 $target";
      self::executeAndOutput($command); }
  }

  protected function deleteExecutorIfExists(){
    $command = 'rm -f '.$this->programExecutorFolder.DIRECTORY_SEPARATOR.$this->programNameMachine;
    self::executeAndOutput($command, "Program Executor Deleted if existed");
    return true;
  }

  protected function saveExecutorFile(){
    $this->populateExecutorFile();
    $executorPath = $this->programExecutorFolder.DIRECTORY_SEPARATOR.$this->programNameMachine;
    file_put_contents($executorPath, $this->bootStrapData);
    $this->changePermissions(null, $executorPath);
  }

  private function populateExecutorFile() {
    $this->bootStrapData = "#!/usr/bin/php\n
<?php\n
exec('".$this->programExecutorCommand."');\n
?>";
  }

}