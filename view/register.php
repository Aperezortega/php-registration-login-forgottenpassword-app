<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='stylesheet' href='../assets/css/style.css'>
    <title>Registration Form</title>
</head>
<body class="bg-light">
<div class="d-flex justify-content-center text-center">
    <div class="col-md-3 mt-4">
        <div class="card m-4">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Enter your details</h2>
                <form action="../controller/registerController.php" method="post">
                <input class="form-control mb-2 text-center" type="text" name="username" id="username" placeholder="Enter your username">
                <input class="form-control mb-2 text-center" type="email" name="email" id="email" placeholder="Enter your email">
                <input class="form-control mb-2 text-center" type="password" name="password" id="password" placeholder="Enter your password">
                <input class="form-control mb-2 text-center" type="password" name="password" id="confirmPassword" placeholder="Confirm your password">
                <input class="btn btn-primary text-center" type="submit" value="Register" name="register">
                </form>
            </div>   
        </div>
    </div>
</div>
<script src="../assets/js/register.js"></script>    
</body>
</html>