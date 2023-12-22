<?php
require_once '../model/User.php';
$token = $_GET['token'];

if(!(User::isTokenValid($token))){
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>test</p>
</body>
</html>