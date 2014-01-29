<?php

phpUnitConsoleExecutor::execute();

class phpUnitConsoleExecutor {

    public static function execute(){
        self::performUnitTests(); }

    private function performUnitTests(){
        $scriptLocation = dirname(__FILE__);
        $fullDir = str_replace("/config/phpunit", "/tests/phpunit", $scriptLocation);
        $command = "phpunit --stderr $fullDir";
        self::executeAndOutput($command); }

    private static function executeAndOutput($command) {
        $outputArray = array();
        exec($command, $outputArray);
        echo "\nOutput for Command $command:\n";
        foreach ($outputArray as $outputValue) {
            echo "$outputValue\n"; } }

}

?>