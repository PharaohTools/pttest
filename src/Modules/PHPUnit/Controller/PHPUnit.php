<?php

Namespace Controller ;

class PHPUnit extends Base {

    protected function defaultExecution($pageVars) {

        if ($pageVars["route"]["action"] == "help") {
            $helpModel = new \Model\Help();
            $this->content["helpData"] = $helpModel->getHelpData($pageVars["route"]["control"]);
            return array ("type"=>"view", "view"=>"help", "pageVars"=>$this->content); }

        if ($pageVars["route"]["action"] == "init" || $pageVars["route"]["action"] == "initialize") {
            $modGroup = "Initializer" ; }

        if ($pageVars["route"]["action"] == "exec" || $pageVars["route"]["action"] == "execute") {
            $modGroup = "Executor" ; }

        $thisModel = $this->getModelAndCheckDependencies(substr(get_class($this), 11), $pageVars, $modGroup) ;
        // if we don't have an object, its an array of errors
        if (is_array($thisModel)) { return $this->failDependencies($pageVars, $this->content, $thisModel) ; }
        $isDefaultAction = self::checkDefaultActions($pageVars, array(), $thisModel) ;
        if ( is_array($isDefaultAction) ) { return $isDefaultAction; }

        return null ;
    }

}