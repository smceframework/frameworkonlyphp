<?php


class SmceFramework
{
    public static function createWebApplication($config)
    {
        if ($config) {
            extract($config);
        }
        require SMCE_BASE_PATH."/lib/SMAutoload.php";
        require SMCE_BASE_PATH."/base/SmBase.php";
        $SmBase=new \SmBase\SmBase();

        \SmBase\SmBase::$config=$config;

        return $SmBase;
    }
}
