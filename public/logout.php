<?php
session_start();
session_destroy();
header("Location:/community/public/login.php");
?>