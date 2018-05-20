<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\SubscribeManager;

ob_start();
include '../../includes/security.php';
include '../../includes/password.php';
include '../../includes/header.php';
?>

<?php
$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";

if(!isset($_POST["submitted"])){
  $UM=new UserManager();
  $existuser=$UM->getUserByEmail($_SESSION["email"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $email=$existuser->email;
  $password=$existuser->password;
  $SM= new SubscribeManager();
}else{
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $password = password_hash($password,PASSWORD_DEFAULT);
 
  


  
  if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
       $update=true;
       $UM=new UserManager();
       if($email!=$_SESSION["email"]){
           $existuser=$UM->getUserByEmail($email);
           if(is_null($existuser)==false){
               $formerror="User Email already in use, unable to update email";
               $update=false;
           }
       }
       if($update){
           $existuser=$UM->getUserByEmail($_SESSION["email"]);
           $existuser->firstName=$firstName;
           $existuser->lastName=$lastName;
           $existuser->email=$email;
           $existuser->password=$password;
           $UM->saveUser($existuser);
           
           //subscribe mailing list
           $SM = new SubscribeManager();
         $subscribeuser = $SM->getUserByEmail($_SESSION[email]);
         if ($subscribeuser!=NULL){
             if(!isset($_POST['subscribe'])){
                 $id=$UM->getUserByEmail($_SESSION[email])->id;
                 $SM->unsubscribe($id, $hashkey);
             }
         }else {
             if(isset($_POST['subscribe'])){
                 $id=$UM->getUserByEmail($_SESSION[email])->id;
                 $SM->subscribe($id, $_SESSION[email]);
             }
         }
           
//            $id=$UM->getUserByEmail($_SESSION[email])->id;
//            $subuser -> subscribe=$subscribeuser
//            ($subscribeuser = "checked"){
//            $SM->subscribe($id, $_SESSION['email']);    
               
//            }

           
           $_SESSION["email"]=$email;
           header("Location:../../home.php");
       }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="css/bootstrap.css">
<!-- Bootstrap End -->
<div class="col-md-6 col-md-offset-3">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1>Update Profile</h1>
<div><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" size="20"></td>
  </tr>
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$password?>" size="20"></td>
  </tr>
  <tr>
  <td>Subscribe to our mailing list
  <td><input type="checkbox" name="subscribe" value="mailing" 
  <?php $subscribeuser = $SM->getUserByEmail($_SESSION["email"]);
  if ($subscribeuser != NULL){
      echo 'checked="checked"';
  }
  
  ?>>
  </td>
  </tr>
  
  
  
  <tr>
	<td></td>
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary"></td>
    </td>
  </tr>
</table>
</form>
</div>

<?php

?>