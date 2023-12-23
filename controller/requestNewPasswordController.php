<?php
require_once '../service/resetEmailService.php';
require_once '../model/User.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(8));
    if(User::isEmailFree($email)){
        header('Location: ../view/requestNewPassword.php?resetEmail=error');
        exit();
    }
    sendResetEmail($email, $token);
    User::insertResetTokenIntoDb($email, $token);
    header('Location: ../index.php?resetEmail=success');
 
}

?>