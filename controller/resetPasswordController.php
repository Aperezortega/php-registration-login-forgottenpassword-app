<?php
require_once '../service/resetEmailService.php';
require_once '../model/db.php';
require_once '../model/User.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(8));
    sendResetEmail($email, $token);
    User::insertResetTokenIntoDb($email, $token);
 
}

?>