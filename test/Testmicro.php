<?php

@ob_start();

class Testmicro  extends PHPUnit_Framework_TestCase
{
	public function test()
    {
        include "testmicro/index.php";
    }
}