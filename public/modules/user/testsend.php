<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

require '../../../PHPMailer/PHPMailer/src/Exception.php';
require '../../../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    		
            //Set SMTP host name
            $mail->Host = "in-v3.mailjet.com";
            //Set this to true if SMTP host requires authentication
            $mail->SMTPAuth = true;
            $mail ->SMTPKeepAlive = true;
            //$mail->SMTPSecure = 'ssl';
            //Provide username and password
            $mail->Username = "fae3e660e9611acf03adad61623c178c";
            $mail->Password = "e5bbdd37d6c6a5e7afe76b8bfca6f937";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            //$mail->Port = 587;
            $mail->Port = 25;

	
	
    //Recipients
                $mail->From = "jackyin1996@gmail.com";
            $mail->FromName = "Admin";

//	$mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('jackyin1996@gmail.com', 'Joe User');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}