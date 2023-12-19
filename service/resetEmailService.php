<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
public static function sendResetEmail($email, $token){
    $credentialsFile = fopen("../credentials.txt", "r") or die("No se pudo abrir el archivo");
    $credentialsData = file($credentialsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    fclose($archivosCredenciales);

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
        }
        

    }else{
        echo 'credentials not found';
    }

}
?>