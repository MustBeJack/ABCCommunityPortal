<?php
session_start();
// require_once '../../includes/autoload.php';
require_once "phpmailer/PHPMailerAutoload.php";
include '../../includes/security.php';
include '../../includes/header.php';
//include '../../includes/PHPMailer/src/PHPMailer.php';
//require '../../includes/PHPMailer/src/Exception.php';
//require '../../includes/PHPMailer/src/PHPMailer.php';
//require '../../includes/PHPMailer/src/SMTP.php';

require '../../../PHPMailer/PHPMailer/src/Exception.php';
require '../../../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/PHPMailer/src/SMTP.php';

use classes\business\SubscribeManager;

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
$SM = new SubscribeManager();

if(isset($_REQUEST['check_list'])){
    $checkbox = $_REQUEST['check_list'];
    //create array people
    foreach ($checkbox as $value){
        array_push($email, $value);
    }
    $_SESSION['email_array'] = $email;
    var_dump($email);
}

//$subsribeduser = $SM -> getUserByEmail ($em)

if(isset($_POST["submit"])){
$email = explode(',',$_POST["email"]);
echo 'Start';
var_dump($email);
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
            $mail ->SMTPKeepAlive = true;
            //$mail->SMTPSecure = 'ssl';
            //Provide username and password
            $mail->Username = "";
            $mail->Password = "";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            //$mail->Port = 587;
            $mail->Port = 25;
            //your registered email
            $mail->From = "";
            $mail->FromName = "Admin";
//             Messsage part

            foreach ($email as $recipent){
            $mail-> addBCC($recipent);
            echo $recipent;
            $subsribeduser = $SM -> getUserByEmail ($recipent);
            var_dump($subsribeduser);
            $id = $SM->getUserByEmail($recipent)->id;
            $hashkey = $SM->getUserByEmail($recipent)->hashkey;
            $link = '/*unsubscribe.php'*/;
            $mail->isHTML(true);
            $mail->Subject = "Bulk Mail";
            $mail->Body ="<h1> Hi Developer</h1><p>".$_POST["message"]."</p><p><a href = {$link}?id={$id}&hashkey={$hashkey}>Link</a></p>";
            $mail->AltBody = "This is the plain text version of the email content";
            if(!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            
            
            
            
            
            else
            {
             
                echo "Message has been sent successfully";
                $mail -> clearAllRecipients();
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
  <label for="Message">Message</label>
 </td>
 <td valign="top">
  <textarea  name="message" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" name="submit" value="Submit Email Form">
 </td>
</tr>
</table>
</form>