

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>sidebar</title>
</head>
<body>
    <h1 class="d-none">sidebar</h1>
    <div class="sidebar d-flex flex-column flex-shrink-0 bg-white shadow fixed-top" style="height:100vh">
        <a href="/" class="d-flex gap-2 justify-content-center justify-content-md-start align-items-center p-2 link-dark text-decoration-none">
            <img src="./assets/img/avatar.jpg" class="thumbnail-profile-picture rounded-circle" alt="profile picture">
            <span id="username" class="d-none d-md-flex">SARA ENRIKEY</span>
        </a>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item">
                <a href="#" class="nav-link profile-nav-link d-flex gap-2 py-3 border-bottom rounded-0 align-items-center  justify-content-center">
                    <i class="sidebar-navs-icons bi bi-person-fill" style="font-size: 20px;"></i>
                    <span class="sidebar-navs-title d-none d-md-flex">Profile</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link dashboard-nav-link p-3 border-bottom rounded-0 align-items-center d-flex gap-2 justify-content-center">
                    <i class="sidebar-navs-icons bi bi-speedometer2" style="font-size: 20px;"></i>
                    <span class="sidebar-navs-title d-none d-md-flex">Dashboard</span>
                </a>
            </li>
        </ul>
        <a href="" class="text-decoration-none">
            <div class="btn btn-light text-dark w-100 border rounded-0 d-flex justify-content-center gap-1">
                <i class="sidebar-navs-icons bi bi-box-arrow-right" style="font-size: 20px;"></i>
                <span class="sidebar-navs-title d-none d-md-flex">log out</span>
            </div>
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>