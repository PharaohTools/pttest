<?php

Namespace Info;

class PTTestRequiredInfo extends Base {

    public $hidden = true;

    public $name = "PTTest Required Models";

    public function __construct() {
      parent::__construct();
    }

    public function routesAvailable() {
      return array( "PTTestRequired" =>  array_merge(parent::routesAvailable() ) );
    }

    public function routeAliases() {
      return array();
    }

    public function helpDefinition() {
      $help = <<<"HELPDATA"
  This module provides no commands, but is required for PTTest. It provides Models which are required for PTTest.


HELPDATA;
      return $help ;
    }

}