<?php

$bootStrap = new bootStrapForTests();
$bootStrap->launch();

function bsAutoLoad($className) {
    $classNameForLoad = str_replace('\\' , '/', $className);
    $filename = dirname(__FILE__) .  '/' . $classNameForLoad.'.php';
    $filename = str_replace("build/tests/phpunit/", "src/", $filename);
    if (is_readable($filename)) require_once $filename;
}

class bootStrapForTests {

    public function launch() {
        spl_autoload_register('bsAutoLoad');
    }

}