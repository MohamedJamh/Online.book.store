<?php
    include('script.php');

    if(!isset($_SESSION['id_admin'])) header('location:login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Gestion Des Livres | Dashboard </title>
    
</head>
<body class="bg-light">
    <div class="sidebar d-flex flex-column flex-shrink-0 bg-white shadow fixed-top" style="height:100vh">
        <a href="/" class="d-flex gap-2 justify-content-center justify-content-md-start align-items-center p-2 link-dark text-decoration-none">
            <img src="./assets/img/profile-thumbnail/<?php echo $_SESSION['thumbnail']  ?>" class="thumbnail-profile-picture rounded-circle" alt="profile picture">
            <span id="username" class="d-none d-md-flex"><?php echo $_SESSION['f_name'] . " "; echo $_SESSION['l_name'] ?></span>
        </a>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item">
                <a href="profile.php" class="nav-link profile-nav-link d-flex gap-2 py-3 border-bottom rounded-0 align-items-center  justify-content-center">
                    <i class="sidebar-navs-icons bi bi-person-fill" style="font-size: 20px;"></i>
                    <span class="sidebar-navs-title d-none d-md-flex">Profile</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link active dashboard-nav-link p-3 border-bottom rounded-0 align-items-center d-flex gap-2 justify-content-center">
                    <i class="sidebar-navs-icons bi bi-speedometer2" style="font-size: 20px;"></i>
                    <span class="sidebar-navs-title d-none d-md-flex">Dashboard</span>
                </a>
            </li>
        </ul>
        <form method="POST">
            <button class="btn btn-light text-dark w-100 border rounded-0 d-flex justify-content-center gap-1" name="logout" type="submit">
                <i class="sidebar-navs-icons bi bi-box-arrow-right" style="font-size: 20px;"></i>
                <span class="sidebar-navs-title d-none d-md-flex">log out</span>
            </button>
        </form>
    </div>
    <div class="container">
        <div class="main dashboard">
            <div class="d-flex flex-column gap-1 pe-3">
                <div class="greating">
                    <h1>Welcome To Your Books Dashboard <img src="./assets/img/waving.png" alt="waving hand" width="45px" height="45px"></h1>
                </div>
                <div class="statistics d-flex gap-3 flex-wrap justify-content-around">
                    <div id="availableBooksStats " class="stats d-flex gap-2 rounded-3 p-2">
                        <div class="stats-icon">
                            <div class="spinner-border text-warning mt-2" role="status">
                            </div>
                        </div>
                        <div class="stats-body d-flex flex-column">
                            <span class="stats-title">Available Books</span>
                            <span class="stats-details"><?php echo available_books_stats()?></span>
                        </div>
                    </div>
                    <div id="soldBooksStats " class="stats d-flex gap-2  rounded-3 p-2">
                        <div class="stats-icon pt-1">
                            <i class="bi bi-cart3 text-warning"></i>
                        </div>
                        <div class="stats-body d-flex flex-column">
                            <span class="stats-title">Sold books</span>
                            <span class="stats-details"><?php echo sold_books_stats()?></span>
                        </div>
                    </div>
                    <div id="earningsStats " class="stats d-flex gap-2  rounded-3 p-2">
                        <div class="stats-icon pt-2">
                            <i class="bi bi-currency-bitcoin text-warning"></i>
                        </div>
                        <div class="stats-body d-flex flex-column">
                            <span class="stats-title">Earnings</span>
                            <span class="stats-details">$<?php echo earnings_books_stats()?></span>
                        </div>
                    </div>
                    <div id="bestCategorieStats " class="stats d-flex gap-2  rounded-3 p-2">
                        <div class="stats-icon pt-1">
                            <i class="bi bi-award text-warning"></i>
                        </div>
                        <div class="stats-body d-flex flex-column">
                            <span class="stats-title">Best Categorie</span>
                            <span class="stats-details">Science</span>
                        </div>
                    </div>
                </div>
                <div class="add-section d-flex flex-row-reverse">
                    <a href="add-book.php" class="text-decoration-none " style="font-size: 25px;font-weight:bold;">+</a>
                </div>
                <div class="book-section d-flex gap-3 flex-wrap justify-content-around">
                    <?php display_books(); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>