<!-- Navigation Bar -->
<?php 
// echo __DIR__;
// $d = __DIR__;
// $e = $_SERVER['DOCUMENT_ROOT'];
// $ini = parse_ini_file("{$e}/phpcrudsample/config/phpcrudsample.ini");
// $dir=__DIR__;
// $ini = parse_ini_file("/../../phpcrudsample/config/phpcrudsample.ini");

//$ini = parse_ini_file("../../config/phpcrudsample.ini");
//$directory = $ini["directory"];
//$url = $ini['url'];
include_once __DIR__."/../../classes/data/UserManagerDB.php";
include_once __DIR__."/../../classes/data/SubscribeManagerDB.php";
include_once __DIR__."/../../classes/entity/User.php";
include_once __DIR__."/../../classes/business/UserManager.php";
include_once __DIR__."/../../classes/business/SubscribeManager.php";
include_once __DIR__."/../../classes/util/config.php";
include_once __DIR__."/../../classes/util/DBUtil.php";
include_once __DIR__."/../../classes/business/Validation.php";

require_once 'autoload.php';
use classes\util\Config;

$config = new Config();
$url = $config::getBaseUrl();

//include_once ("autoload.php");

   if(isset($_SESSION["role"]))
   {
      if($_SESSION["role"]=="admin")
      {
?>

<!-- Boostrap -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs">
                <h2 style="color: white">ABC JOB</h2>
        <li class="active">
          <a href= "<?=$url?>public/home.php"></i>Home</a>
        </li>
        <li>
          <a href="<?=$url?>public/modules/user/updateprofile.php">Update Profile</a>
        </li>
        <li>
             <a href="<?=$url?>public/modules/user/userlistadmin.php">Manage Users</a>
        </li>
        <li>
          <a href="<?=$url?>public/modules/user/searchuser.php">Search User</a>
        </li>
        <li>
          <a href="<?=$url?>public/contactus.php">Contact</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="<?=$url?>public/logout.php">Logout</a></a></li>
    </ul>
  </nav>


<!-- <div class="w3-bar w3-black w3-large">
  <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="width:55px; height:35px">
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
  <a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
  <a href="/phpcrudsample/public/modules/user/userlistadmin.php" class="w3-bar-item w3-button w3-mobile">Manage Users</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
  <a href="/phpcrudsample/public/modules/user/searchuser.php" class="w3-bar-item w3-button w3-mobile">Search User</a>
  <a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout</a>
</div> -->
<?php 
   } else
   {
?>





<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>






<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs">
                <h2 style="color: white">ABC JOB</h2>
        <li class="active">
          <a href="<?=$url?>public/home.php"></i>Home</a>
        </li>
        <li>
          <a href="<?=$url?>public/modules/user/updateprofile.php">Update Profile</a>
        </li>
        <li>
            <a href="<?=$url?>public/modules/user/userlist.php">View Users</a>
        </li>
        <li>
          <a href="<?=$url?>public/modules/user/searchuser.php">Search User</a>
        </li>
        <li>
          <a href="<?=$url?>public/contactus.php">Contact</a>
        </li>
        <li>
            <a href="<?=$url?>public/logout.php">Logout</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="<?=$url?>public/logout.php">Logout</a></a></li>
    </ul>
  </nav>






<!-- <div class="w3-bar w3-black w3-large">
  <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="width:55px; height:35px">
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
  <a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
  <a href="/phpcrudsample/public/modules/user/userlist.php" class="w3-bar-item w3-button w3-mobile">View Users</a>
  <a href="/phpcrudsample/public/modules/user/searchuser.php" class="w3-bar-item w3-button w3-mobile">Search User</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
  <a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout</a>
</div> -->
<?php 
  }
   }else
   {
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->



<nav class="navbar navbar-inverse">
    <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs">
                <h2 style="color: white">ABC JOB</h2>
        <li>
            <a href="<?=$url?>public/frontpage.php">Home</a>
        </li>
        <li>
            <a href="<?=$url?>public/aboutus.php">About Us</a>
        </li>
        <li>
            <a href="<?=$url?>public/contactus.php">Contact</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li>  <a href="<?=$url?>public/login.php">LogIn</a></li>
    </ul>
  </nav>







<!-- <div class="w3-bar w3-black w3-large">
  <img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="width:55px; height:35px">
  <a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
  <a href="/phpcrudsample/public/aboutus.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>About Us</a>
  <a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
  <a href="/phpcrudsample/public/login.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Login</a>
</div> -->
<?php 
   } 
?>