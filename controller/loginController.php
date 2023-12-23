<?php
require_once '../model/login.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = new Login($username, $password);
    
    if($login->login()){
        session_start();
        $_SESSION['username'] = $username;
        header('Location: ../index.php?login=success');
    }else{
        header('Location: ../view/loginView.php?login=failed');
    }
}
?> 