<?php

Namespace Info;

class PHPUnitInfo extends Base {

    public $hidden = false;

    public $name = "PHPUnit - Initialize or Execute a PHPUnit Test Suite";

    public function __construct() {
      parent::__construct();
    }

    public function routesAvailable() {
      return array( "PHPUnit" =>  array_merge(parent::routesAvailable(), array() ) );
    }

    public function routeAliases() {
      return array("phpunit"=>"PHPUnit");
    }

    public function modelGroups() {
        return array("init"=>"Initializer","initialize"=>"Initializer", "exec" => "Executor", "execute" => "Executor" );
    }

    public function autoPilotVariables() {
      return array(
        "PHPUnit" => array(
          "PHPUnit" => array(
            "programNameMachine" => "phpunit", // command and app dir name
          )
        )
      );
    }

    public function helpDefinition() {
      $help = <<<"HELPDATA"
  This command allows you to initialize a PHPUnit test suite.

  PHPUnit, phpunit

        - init, initialize
        Initialises the PHPUnit test suite of this project
        example: testingkamen phpunit init
        example: testingkamen phpunit initialize

        - execute
        Executes the PHPUnit test suite of this project
        example: testingkamen phpunit execute

HELPDATA;
      return $help ;
    }

}