<?php

Namespace Info;

class AutopilotInfo extends PTConfigureBase {

    public $hidden = false;

    public $name = "PTConfigure Autopilot - User Defined Installations";

    public function __construct() {
      parent::__construct();
    }

    public function routesAvailable() {
      return array( "Autopilot" =>  array_merge(parent::routesAvailable(), array("install", "execute") ) );
    }

    public function routeAliases() {
      return array("auto"=>"Autopilot", "autopilot"=>"Autopilot");
    }

    public function helpDefinition() {
      $help = <<<"HELPDATA"
  This command is part of a default Module and provides you with a method by
  which you can perform user defined executions of any PTConfigure Modules, in
  any order, and with your own predefined settings.

  Autopilot, autopilot, auto

    - install, execute
    execute all of the defined modules in your Autopilot file
    example: ptconfigure autopilot install --autopilot-file=*path-to-file*

HELPDATA;
      return $help ;
    }

}