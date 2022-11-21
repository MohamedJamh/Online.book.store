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
    <title>Gestion Des Livres | Book Overview </title>
</head>
<body>
    <body class="bg-light">
        <div class="sidebar d-flex flex-column flex-shrink-0 bg-white shadow fixed-top" style="height:100vh">
            <a href="/" class="d-flex gap-2 justify-content-center justify-content-md-start align-items-center p-2 link-dark text-decoration-none">
                <img src="./assets/img/profile-thumbnail/<?php echo $_SESSION['thumbnail']  ?>" class="thumbnail-profile-picture rounded-circle" alt="profile picture">
                <span id="username" class="d-none d-md-flex"><?php echo $_SESSION['f_name'] . " "; echo $_SESSION['l_name'] ?></span>
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
        <div class="container">
            <div class="main book-overview">
                <div class="d-flex flex-column gap-1 pe-3">
                    <h1 class="pt-3 ps-2">Book Overview.</h1>
                    <div class="d-flex gap-3 flex-wrap justify-content-around ">
                        <div class="card book-picture border-0 shadow-lg overflow-hidden">
                            <img src="./assets/img/books/green book.jpg" class="card-img-top img-fluid" alt="...">
                        </div>
                        <div class="inputs-modal container p-3 rounded bg-white shadow" style="max-width: 500px;">
                            <form action="" method="post">
                                <div class="d-flex flex-column gap-3">
                                    <input type="text" class="form-control mb-2" placeholder="Books title" value="<?php echo $_SESSION['book_title']; ?>" >
                                    <input type="text" class="form-control mb-2" placeholder="Written by">
                                    <textarea class="form-control" placeholder="Description"></textarea>
                                    <select name="" id="" class="form-control">
                                        <option>Select Categorie</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                    <input type="file" class="form-control" accept="image/*">
                                    <div class="d-flex gap-1">
                                        <input type="text" class="form-control mb-2" placeholder="Price" >
                                        <input type="text" class="form-control mb-2" placeholder="Available" >
                                        <input type="text" class="form-control mb-2" placeholder="Sold">
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <div class="col col-md-3 mb-2">
                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                                    </div>
                                    <div class="col col-md-3 mb-2">
                                        <button type="submit" class="btn btn-warning w-100 text-white">Update</button>
                                    </div>
                                    <div class="col col-md-3">
                                        <button type="submit" class="btn btn-light border w-100">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="./assets/js/script.js"></script>
    </body>
</body>
</html>