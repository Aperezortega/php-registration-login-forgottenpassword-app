<?php
require_once '../service/resetEmailService.php';
require_once '../model/db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(8));
    ResetEmailService::sendResetEmail($email, $token);



    
}

?>