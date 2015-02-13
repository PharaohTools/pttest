<?php

Namespace Info;

class BehatInfo extends Base {

    public $hidden = false;

    public $name = "Behat - Initialize or Execute a Behat Test Suite";

    public function __construct() {
      parent::__construct();
    }

    public function routesAvailable() {
      return array( "Behat" =>  array_merge(parent::routesAvailable(), array() ) );
    }

    public function routeAliases() {
      return array("behat"=>"Behat");
    }

    public function modelGroups() {
        return array("init"=>"Initializer","initialize"=>"Initializer");
    }

    public function helpDefinition() {
      $help = <<<"HELPDATA"
  This command allows you to initialize a Behat test suite.

  Behat, behat

        - init, initialize
        Initialises the Behat test suite of this project
        example: pttest behat init
        example: pttest behat initialize

        - execute
        Executes the Behat test suite of this project
        example: pttest behat execute

HELPDATA;
      return $help ;
    }

}