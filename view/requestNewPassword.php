<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Password Reset</title>
</head>
<body class="bg-light">
    <div>
        <div class="d-flex justify-content-center text-center">
            <div class="col-md-3 mt-4">
                <div class="card m-4">
                    <div class="card-body">
                        <h3 class="text-center mt-4">Request Email with password reset link</h3>
                        <form action="../controller/requestNewPasswordController.php" method="post">
                            <input class="form-control mb-2 text-center" type="email" name="email" placeholder="Enter your email">
                            <input class="btn btn-primary mb-2" type="submit" value="Request">
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</body>
</html>