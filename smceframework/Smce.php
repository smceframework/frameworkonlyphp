<?php

use Smce\Core\SmLayout;
use Smce\Core\SmUser;
use Smce\Core\SmCli;

class Smce extends SmCli
{
    private static $SmUser = null;
    private static $SmLayout = null;

    public static function app()
    {
      if (static::$SmUser === null) {
        static::$SmUser=new SmUser();
      }
      return static::$SmUser;
    }

    public static function theme()
    {
      if (static::$SmLayout === null) {
        static::$SmLayout=new SmLayout();
      }
      return static::$SmLayout;
    }

}
