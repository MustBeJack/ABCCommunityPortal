<?php
use classes\util\DBUtil;

require 'Subscribe.php';


/*
$sm = new Subscribe();
$tb = $sm :: getAllUsers();
var_dump($tb);
*/
$test  = DBUtil::getConnection();
var_dump($test);