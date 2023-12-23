<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Registration and login app</title>
</head>
<body class="bg-light">
<?php
session_start();
if(isset($_SESSION['username'])){
    echo '<h2 class="text-center mt-4">Welcome '.$_SESSION['username'].'</h2>
    <div class="text-center">
    <a href="/controller/logoutController.php">Logout</a>
    </div>';
}else{
    echo '
    <h2 class="text-center mt-4">Registration and login app</h2>
    <div class="text-center">
    <a href="/view/loginView.php">Login or register here!</a>
    </div>
    ';
}
?>
<script src="assets/js/index.js"></script>  
</body>
</html>