<?php

phpUnitHtmlExecutor::execute();

class phpUnitHtmlExecutor {

    public static function execute(){
//        self::emptyOldFiles();
        self::performUnitTests(); }

    private function performUnitTests(){
        $scriptLocation = dirname(__FILE__);
        $fullTestDir = str_replace("/config/phpunit", "/tests/phpunit", $scriptLocation);
        $fullReportDir = str_replace("/config/phpunit", "/reports/phpunit/html", $scriptLocation);
        $command = "phpunit --coverage-html $fullReportDir --stderr $fullTestDir";
        self::executeAndOutput($command); }

    private function emptyOldFiles(){
        $command = 'rm -rf ../../reports/phpunit/html/*';
        self::executeAndOutput($command); }

    private static function executeAndOutput($command) {
        $outputArray = array();
        exec($command, $outputArray);
        echo "\nOutput for Command $command:\n";
        foreach ($outputArray as $outputValue) {
            echo "$outputValue\n"; } }

}

?>