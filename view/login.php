<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or register here</title>
</head>
<body>
    <div>
        <form action="../controller/loginController.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <input type="submit" value="Login" name="login">
        </form>
        <a href="register.php">Dont have a username? Register here</a>
    </div>
</body>
</html>