<?php
require_once '../model/User.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_SESSION['id_user'];
    $password = $_POST['password'];
    User::updatePassword($id_user, $password);
    header('Location: ../view/loginView.php?passwordChanged=1');
}else{
    echo 'Something went wrong';
}



?>