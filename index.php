<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
    echo 'Welcome '.$_SESSION['username'];
    echo '<br><a href="logout.php">Logout</a>';
}else{
    echo '<a href="/view/login.php">Login or register here!</a>';
}
?>  
</body>
</html>