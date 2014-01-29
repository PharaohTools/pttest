<?php

class GCCodePracticeControllerBaseClassTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        require_once("bootstrap.php");
    }

    public function testMock() {
        $this->assertTrue( 1 == 1 );
    }

}
