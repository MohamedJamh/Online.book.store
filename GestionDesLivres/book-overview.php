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
        <?php
            include('sidebar.php');
        ?>
        <div class="container">
            <div class="main book-overview">
                <div class="d-flex flex-column gap-1 pe-3">
                    <h1 class="pt-3 ps-2">Book Overview.</h1>
                    <div class="d-flex gap-3 flex-wrap justify-content-around ">
                        <div class="card book-picture border-0 shadow-lg overflow-hidden" style="height: max-content;">
                            <img src="./assets/img/books/<?php echo $_SESSION['book_cover_path']; ?>" class="card-img-top img-fluid" alt="book <?php echo $_SESSION['book_description']; ?>">
                        </div>
                        <div class="inputs-modal container p-3 rounded bg-white shadow" style="max-width: 500px;">
                            <form  id="inputs_modal" action="" method="POST" enctype="multipart/form-data">
                                <div class="d-flex flex-column gap-3">
                                    <input type="text" class="form-control mb-2 visually-hidden" name="book-id-overview" value="<?php echo $_SESSION['book_id']; ?>" >
                                    <input type="text" class="form-control mb-2" name="book-title-overview" placeholder="Books title" value="<?php echo $_SESSION['book_title']; ?>" >
                                    <input type="text" class="form-control mb-2" name="book-autor-overview" placeholder="Written by" value="<?php echo $_SESSION['book_autor']; ?>">
                                    <textarea class="form-control" name="book-description-overview" placeholder="Description"><?php echo $_SESSION['book_description'];?></textarea>
                                    <select name="book-categorie-overview" id="" class="form-control" >
                                        <option value="0">Select Categorie</option>
                                        <?php generate_categories($_SESSION['book_categorie']);?>
                                    </select>
                                    <input id="cover-selector" type="file" name="book-cover-overview" class="form-control" accept="image/*">
                                    <div class="d-flex gap-1">
                                        <input type="number" class="form-control mb-2" name="book-price-overview" placeholder="Price" value="<?php echo $_SESSION['book_price']; ?>" >
                                        <input type="number" class="form-control mb-2" name="book-available-overview" placeholder="Available" value="<?php echo $_SESSION['book_available']; ?>" >
                                        <input type="number" class="form-control mb-2" name="book-sold-overview" placeholder="Sold" value="<?php echo $_SESSION['book_sold']; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <div class="col col-md-3 mb-2">
                                        <button type="submit" name="delete-book" class="btn btn-danger w-100">Delete</button>
                                    </div>
                                    <div class="col col-md-3 mb-2">
                                        <button type="submit" name="update-book" class="btn btn-warning w-100 text-white">Update</button>
                                    </div>
                                    <div class="col col-md-3">
                                        <a href="index.php">
                                            <div class="btn btn-light border w-100">Cancel</div>
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
                            <?php if(isset($GLOBALS['message'])): ?>
                                <div class="container p-0 mt-3" style="max-width: 500px;">
                                    <div class="alert border bg-success rounded shadow-lg m-0 d-flex justify-content-between text-white" >
                                        <?php
                                            echo $GLOBALS['message'];
                                            unset($GLOBALS['message']);
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
</body>
</html>