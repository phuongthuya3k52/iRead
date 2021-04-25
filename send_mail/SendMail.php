<?php
require_once __DIR__."/PHPMailer/src/PHPMailer.php";
require_once __DIR__."/PHPMailer/src/Exception.php";
require_once __DIR__."/PHPMailer/src/OAuth.php";
require_once __DIR__."/PHPMailer/src/POP3.php";
require_once __DIR__."/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 function send($title, $content, $nTo, $mTo, $diachicc ='')
    {
         // Passing `true` enables exceptions
        $mail = new PHPMailer(true);                             
        try {
            //Server settings
            $mail->SMTPDebug = 2;                       // Enable verbose debug output
            $mail->isSMTP();                            // Set mail using SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify the primary and secondary SMTP server 
            $mail->SMTPAuth = true;                     // Enable SMTP authentication 
            $mail->Username = 'iread.net.vn@gmail.com'; // SMTP username
            $mail->Password = 'iread123456~';           // SMTP password
            $mail->SMTPSecure = 'tls';                  // Activate the TLS code, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect with 
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipients
            $mail->setFrom('iread.net.vn@gmail.com', 'iread.net.vn@gmail.com');
            $mail->addAddress($mTo, $nTo);   
            // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('duocnguyenit1994@gmail.com', 'Information');  

            //Content
            $mail->isHTML(true);   // Set email format to HTML
            $mail->Subject =  "=?utf-8?b?".base64_encode($title)."?=";
            $mail->Body    = $content;
            $mail->AltBody = '';

            $mail->send();
            return true;
        } catch (Exception $e) {
            
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
?>


