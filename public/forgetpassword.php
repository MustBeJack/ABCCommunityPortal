<?php
use classes\business\UserManager;
use classes\business\Validation;
require_once "phpmailer/PHPMailerAutoload.php";
require_once 'includes/autoload.php';
include 'includes/header.php';
include 'includes/password.php';
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
			//hash password
			$hashedpwd = password_hash($newpassword[0],PASSWORD_DEFAULT);
			// echo $newpassword[0]. '<br>';
			// echo $hashedpwd;
			//update database with new password
			$UM->updatePassword($email,$hashedpwd);  
			//$formerror="Valid email user. password: ".$newpassword[0];
			//coding for sending email
			// do work here
			$mail = new PHPMailer;
			// Enable SMTP debugging.
			// $mail->SMTPDebug = 3;
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();
			//Set SMTP host name
			$mail->Host = "in-v3.mailjet.com";
			//Set this to true if SMTP host requires authentication
			$mail->SMTPAuth = true;
			//$mail->SMTPSecure = 'ssl';
			//Provide username and password
			$mail->Username = //username//;
			$mail->Password = //password//;
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";
			//Set TCP port to connect to
			//$mail->Port = 587;
			$mail->Port = 587;

			$mail->From = //email//
			$mail->FromName = "Admin";
			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject = "Password Recovery";
			$mail->Body = "<i>Here is your new password: </i>".$newpassword[0];
			$mail->AltBody = "This is the plain text version of the email content";
			if(!$mail->send())
			{
			    echo "Mailer Error: " . $mail->ErrorInfo;
			}
			else
			{
			    echo "Message has been sent successfully";
			}
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
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}" required title="Cannot be empty field" size="30"></td>
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