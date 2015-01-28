<?php

@ob_start();

class Testmicro2 extends PHPUnit_Framework_TestCase
{
	public function test()
    {
        include "testmicro2/index.php";
    }
}