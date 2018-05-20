<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
include '../../includes/password.php';
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";


if(!isset($_POST["submitted"])){
  $UM=new UserManager();
  $existuser=$UM->getUserById($_GET["id"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $email=$existuser->email;
  $password=$existuser->password;
  
}
else
{
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $email=$_POST["email"];
  $password=$_POST["password"];
    $password = password_hash($password,PASSWORD_DEFAULT);
  if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
       $update=true;
       $UM=new UserManager();
       // if($email!=$_SESSION["email"]){
       //     $existuser=$UM->getUserById($email);
       //     if(is_null($existuser)==false){
       //         $formerror="User Email already in use, unable to update email";
       //         $update=false;
       //     }
       // }
       if($update){
           $existuser=$UM->getUserById($_GET["id"]);
           $existuser->firstName=$firstName;
           $existuser->lastName=$lastName;
           $existuser->email=$email;
           $existuser->password=$password;
           $UM->saveUser($existuser);
           $_SESSION["email"]=$email;
           header("Location:../../modules/user/userlistadmin.php");
       }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1>Update Profile</h1>
<div><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" pattern="[a-zA-Z]{3,20}" value="<?=$firstName?>" size="20" title="Name should be between 3-20 characters"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" pa size="20" pattern="[a-zA-Z]{3,20}" title="Last name should be between 3-20 characters"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50" pattern="[^ @]*@[^ @]*" title="Please enter a valid email"></td>
  </tr>
  <form onsubmit=" return myFunction()" method="post">
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" pattern="{1-20}" size="20" title="invalid password"></td>
  </tr>
</form>
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$password?>" patterm="{1-20}" title="invalid password" size="20"></td>
  </tr>
  <tr>
	<td></td>
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary"></td>
    </td>
  </tr>
</table>
</form>
<script type="javascript">function myFunction() {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    var ok = true;
    if (pass1 != pass2) {
        //alert("Passwords Do not match");
        document.getElementById("pass1").style.borderColor = "#E34234";
        document.getElementById("pass2").style.borderColor = "#E34234";
        ok = false;
    }
    else {
        alert("Passwords Match!!!");
    }
    return ok;
}</script>


<?php
include '../../includes/footer.php';
?>