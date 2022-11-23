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
    <title>Gestion Des Livres | Add New Book </title>
</head>
<body>
    <?php
        include('sidebar.php');
    ?>
    <div class="container">
        <div class="main add-book">
            <div class="d-flex flex-column gap-1 pe-3 mb-3">
                <h1 class="pt-3 ps-2">Add New Book.</h1>
                <div class="d-flex gap-3 flex-wrap justify-content-around ">
                    <div class="card book-picture border-0 shadow-lg overflow-hidden">
                        <img class="card-img-top img-fluid" alt="">
                    </div>
                    <div class="inputs-modal container p-3 rounded bg-white shadow" style="max-width: 500px;">
                        <form id="inputs_modal" action="" method="POST" enctype="multipart/form-data">
                            <div class="d-flex flex-column gap-3">
                                <input type="text" class="form-control mb-2" placeholder="Books title" name="title">
                                <input type="text" class="form-control mb-2" placeholder="Written by" name="autor">
                                <textarea class="form-control" placeholder="Description" name="description"></textarea>
                                <select name="categorie" id="" class="form-control">
                                    <option value="0">Select Categorie</option>
                                    <?php generate_categories() ;?>
                                </select>
                                <input id="cover-selector" type="file" name="book-cover" class="form-control" accept="image/*">
                                <div class="d-flex gap-1">
                                    <input type="number" class="form-control mb-2" name="price" placeholder="Price">
                                    <input type="number" class="form-control mb-2" name="available" placeholder="Available">
                                    <input type="number" class="form-control mb-2" name="sold" placeholder="Sold">
                                </div>
                            </div>
                            <div class="row mt-4 mb-2">
                                <div class="col-12 col-md-3 mb-2">
                                    <button type="submit" class="btn btn-primary w-100" name="add-book">Add</button>
                                </div>
                                <div class="col col-md-3">
                                    <a href="index.php">
                                        <div class="btn btn-light w-100 text-dark border">Cancel</div>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <?php if(isset($GLOBALS['error-message'])): ?>
                            <div class="container p-0 mt-3" style="max-width: 500px;">
                                <div class="alert border bg-warning rounded shadow-lg m-0 d-flex justify-content-between text-dark" >
                                    <?php
                                        echo $GLOBALS['error-message'];
                                        unset($GLOBALS['error-message']);
                                    ?>
                                    <span class="btn btn-close bg-white " data-bs-dismiss='alert'></span>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>