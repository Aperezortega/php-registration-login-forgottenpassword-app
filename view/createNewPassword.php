<?php
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='stylesheet' href='../assets/css/style.css'>
    <title>New Password</title>
</head>
<body>
    <div class="d-flex justify-content-center text-center">
        <div class="col-md-3">
            <div class="card">
                <div class=card-body>
                <form action="../controller/createNewPasswordController.php" method="post">
                    <h2>Create New Password</h2>
                    <input class="form-control mb-3 text-center" type="password" name="password" id="password" placeholder="Password">
                    <input class="form-control mb-3 text-center" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                    <input class="btn btn-primary m-4" type="submit" value="Change Password" name="changePassword">
                </form>
                </div>
            </div>
        </div>
    </div>
<script src="../assets/js/register.js"></script>
</body>
</html>