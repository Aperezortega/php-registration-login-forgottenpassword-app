<?php
require_once '../model/User.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(User::isEmailFree($email)){
        $user = new User($username,$email,$password);
        header('Location: ../index.php?register=success');
        exit();
    }else{
        header('Location: ../view/register.php?register=failed&error=emailTaken');
        exit();
    }
    
}
?>