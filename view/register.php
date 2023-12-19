<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
    <form action="../controller/registerController.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Enter your username">
        <input type="email" name="email" id="email" placeholder="Enter your email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <label for="password">Confirm Password</label>
        <input type="password" name="password" id="confirmPassword" placeholder="Enter your password">
        <input type="submit" value="Register" name="register">
</div>
<script src="../assets/js/register.js"></script>    
</body>
</html>