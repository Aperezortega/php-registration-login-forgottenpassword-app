<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
function sendResetEmail($email, $token){
    $credentialsFile = '../credentials.txt';
    $credentialsData = file($credentialsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    

    if(count($credentialsData) == 2){
        $emailCredential = $credentialsData[0];
        $emailPasswordCredential = $credentialsData[1];
        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $emailCredential;
        $mail-> Password = $emailPasswordCredential;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $subject = 'Reset password';
        $message = 'Click on the link to reset your password: http://localhost:8080/PHP-Login-System/view/resetPassword.php?token='.$token;
        
        $mail->setFrom($emailCredential, 'PHP Login System');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        

    }else{
        echo 'credentials not found';
    }

}
?>