<?php
namespace classes\util;

class Config
{
    public static $config;
    public $mysqlserver;
    public $mysqluser;
    public $mysqlpassword;
    public $mysqldb;
    public $url;
    
    public static function getConfig($reload = false){
        if(isset($config)==false || $reload==true){
            $ini =  parse_ini_file(self::getApplicationRoot()."/config/community.ini");
            $config=new Config();
            $config->mysqlServer=$ini['mysqlserver'];
            $config->mysqlUser=$ini['mysqluser'];
            $config->mysqlPassword=$ini['mysqlpassword'];
            $config->mysqlDB=$ini['mysqldb'];
            $config->url =$ini['url']
;            return $config;
        }
        return $config;
    }
    
    public static function getApplicationRoot(){
        $path = $_SERVER['DOCUMENT_ROOT'] . "/students/m1/run8/jhyin/community";
        return $path;
    }
    
    public static function getBaseUrl(){
        $config  = self::getConfig();
        $url = $config->url;
        return $url;
    }
}

