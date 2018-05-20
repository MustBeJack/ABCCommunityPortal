<?php
// $url = dirname(__FILE__);
// $ini = parse_ini_file("{$url}/../../config/phpcrudsample.ini");
// $project = $ini["project"];
// $url = $ini['url'];

// if(!isset($_SESSION['email'])){
//     header("{$url}/public/login.php");
// $dir=__DIR__;
// $ini = parse_ini_file("$dir/../../phpcrudsample/config/phpcrudsample.ini");

// $login = $ini['path'].'/public/login.php';

if(!isset($_SESSION['email'])){
    header("location: $login");
}

