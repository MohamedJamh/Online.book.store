<?php
    include('script.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
    <title>Gestion | Register</title>
</head>
<body class="bg-light">
    <div class="container p-3 rounded bg-white shadow-lg" style="max-width: 500px; margin-top:20vh;">
        <form action="" method="POST">
            <div>
                <h1 class="mb-3">Register</h1>
            </div>
            <div class="d-flex flex-column gap-2">
                <div class="d-flex gap-3">
                    <input type="text" class="form-control mb-3" placeholder="First Name" name="first_name">
                    <input type="text" class="form-control mb-3" placeholder="Last Name" name="last_name">
                </div>
                <input type="date" class="form-control mb-3" name="dob">
                <input type="email" class="form-control mb-3" placeholder="E-mail Adresse" name="adresse">
                <input type="password" class="form-control mb-3" placeholder="Password" name="password">
                <input type="password" class="form-control mb-3" placeholder="Confirm Password" name="confirm_password">
            </div>
            <div class="d-flex gap-3 mb-2">
                <button type="submit" class="register-btn btn btn-primary" name="signup" >Sign up</button>
                <a href="login.php">
                    <div class="btn btn-light border text-primary" >Sign in</div>
                </a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>