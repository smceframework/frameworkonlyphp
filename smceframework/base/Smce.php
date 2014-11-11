<?php

use SmTemplate\SmTemplate;
use SmLib\SmLayout;
class Smce extends SmLib\SmCli
{
    private static $SmUser = null;
    private static $SmLayout = null;

    public static function app()
    {
      if (static::$SmUser === null) {
        static::$SmUser=new SmLib\SmUser();
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
