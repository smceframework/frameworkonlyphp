<?php

@ob_start();


class Testapp  extends PHPUnit_Framework_TestCase
{
	public function test()
    {
        include "testapp/index.php";
    }
}