<?php


class Smce extends \SMLib\SM_Cli
{
    private static $SMUser = null;
    private static $SMLayout = null;

    public static function app()
    {
      if (static::$SMUser === null) {
        static::$SMUser=new \SMLib\SM_User();
      }

      return static::$SMUser;
    }

    public static function theme()
    {
      if (static::$SMLayout === null) {
        static::$SMLayout=new \SMLib\SM_Layout();
      }

      return static::$SMLayout;
    }

}
