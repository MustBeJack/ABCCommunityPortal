<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
$formerror="";

$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();

if(isset($_POST["submitted"])){
    $email=$_POST["email"];
	$UM=new UserManager();
	$existuser=$UM->getUserByEmail($email);
	if(isset($existuser)){
			//generate new password
			$newpassword=$UM->randomPassword(8,1,"lower_case,upper_case,numbers");
			//update database with new password
			$UM->updatePassword($email,$newpassword[0]);  
			//$formerror="Valid email user. password: ".$newpassword[0];
			//coding for sending email
			// do work here
			
			$formerror="New password have been sent to ".$email;
			//header("Location:home.php");
	}else{
			$formerror="Invalid email user";
	}
}

?>
<html>
<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<body>

<h1>Forget Password</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="100%">
  <tr>    
    <td>Email</td>
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30"></td>
	<td><?php echo $error_name?>
  </tr> 
  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    </td>
  </tr>
  <tr><p style="color:red;"> <?php echo $formerror?></p></tr>
</table>
</form>
<?php
include 'includes/footer.php';
?>