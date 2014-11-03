<?php


class Smce_Framework
{
    public static function createWebApplication($config)
    {
        if ($config) {
            extract($config);
        }
        require SMCE_BASE_PATH."/lib/SM_Autoload.php";
        require SMCE_BASE_PATH."/base/Sm_Base.php";
        $Sm_Base=new \Sm_Base\SM_Base();

        \Sm_Base\SM_Base::$config=$config;

        return $Sm_Base;
    }
}
