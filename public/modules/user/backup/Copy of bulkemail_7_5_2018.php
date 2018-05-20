<?php
session_start();
require_once '../../includes/autoload.php';
require_once "phpmailer/PHPMailerAutoload.php";
include '../../includes/security.php';
include '../../includes/header.php';
require '../../includes/PHPMailer/src/Exception.php';
require '../../includes/PHPMailer/src/PHPMailer.php';
require '../../includes/PHPMailer/src/SMTP.php';
use classes\business\UserManager;
use classes\entity\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 ?>

 <?php

$formerror="";
$firstName="";
$lastName="";
$email=[]; //contain list of selected peeps
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$formerror="";

if(isset($_REQUEST['check_list'])){
    $checkbox = $_REQUEST['check_list'];
    //create array people
    foreach ($checkbox as $value){
        array_push($email, $value);
    }
    $_SESSION['email_array'] = $email;
}



if(isset($_POST["contactform"])){
    $email = explode(',',post["recipient"]);
//         $email=$_POST["email"];
//         $UM=new UserManager();
//         $existuser=$UM->getUserByEmail($email);
//         if(isset($existuser)){
//             //generate new password
//             $newpassword=$UM->randomPassword(8,1,"lower_case,upper_case,numbers");
//             //hash password
//             $hashedpwd = password_hash($newpassword[0],PASSWORD_DEFAULT);
//             // echo $newpassword[0]. '<br>';
//             // echo $hashedpwd;
//             //update database with new password
//             $UM->updatePassword($email,$hashedpwd);
//             //$formerror="Valid email user. password: ".$newpassword[0];
//             //coding for sending email
//             // do work here
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
            $mail->Username = "fae3e660e9611acf03adad61623c178c";
            $mail->Password = "e5bbdd37d6c6a5e7afe76b8bfca6f937";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            //$mail->Port = 587;
            $mail->Port = 587;
            
            $mail->From = "jackyin1996@gmail.com";
            $mail->FromName = "Admin";
//             Messsage part

            
            $mail-> addBCC($email);
            $mail->isHTML(true);
            $mail->Subject = "Bulk Mail";
            $mail->Body = "Bulk test bij";
            $mail->AltBody = "This is the plain text version of the email content";
            if(!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            
            
            
            
            
            else
            {
                echo "Message has been sent successfully";
            }
        }
    }



?>
<form name="contactform" method="post">
<table width="450px">
<tr>
 <td valign="top">
  <label for="email">Email Address *</label>
 </td>
 <td valign="top">
  <input readonly  type="text" name="email" maxlength="80" size="50" value="<?= implode(","."" , $_SESSION['email_array']); ?>">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="25" rows="6" value="<?=$body?>"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit">Email Form</a>
 </td>
</tr>
</table>
</form>