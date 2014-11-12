<?php

use smce\base\SmLib\SmLayout;
use smce\base\SmLib\SmUser;
use smce\base\SmLib\SmCli;

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
