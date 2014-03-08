<?php

class HC_Core_Test extends PHPUnit_Framework_TestCase {

    // @todo: HC_Core_Test Test

    public $passed = false;

    public function testFood()
    {

        $food = new F_Food();

        $food->findBusiness();

    }
}
