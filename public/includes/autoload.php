<?php
use classes\util\Config;

spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . "/community/" .$class_name . '.php';
    /*
//     $e = $_SERVER['DOCUMENT_ROOT'];
//     $ini = parse_ini_file("{$e}/phpcrudsample/config/phpcrudsample.ini");
    $dir=__DIR__;
    var_dump($dir);
    var_dump($_SERVER['DOCUMENT_ROOT']);
//     $ini = parse_ini_file("$dir/../../phpcrudsample/config/phpcrudsample.ini");
    
    
    $directory = $dir["directory"];
    include $_SERVER['DOCUMENT_ROOT'] . "/".$directory .$class_name . '.php';
*/
});


?>