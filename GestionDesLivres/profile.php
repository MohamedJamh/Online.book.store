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
    <title>Gestion Des Livres | Profile </title>
</head>
<body>
    <?php
        $GLOBALS['current-page'] = 'profile';
        include('sidebar.php')
    ?>
    <div class="container">
        <div class="main profile">
            <div class="d-flex flex-column gap-1 pe-3 mb-3">
                <h1 class="pt-3 ps-2">Profile.</h1>
                <div class="d-flex gap-3 flex-wrap justify-content-around ">
                    <div class="card profile-picture border-0 shadow-lg overflow-hidden rounded-circle">
                        <img src="./assets/img/profile-thumbnail/<?php echo $_SESSION['thumbnail']  ?>" class="card-img-top img-fluid" alt="...">
                    </div>
                    <div class="inputs-modal container p-3 rounded bg-white shadow" style="max-width: 500px;">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="d-flex flex-column gap-3">
                                <input type="text" class="form-control mb-2" name="f_name" value="<?php echo $_SESSION['f_name'] ?>" placeholder="First name" >
                                <input type="text" class="form-control mb-2" name="l_name" value="<?php echo $_SESSION['l_name'] ?>" placeholder="Last name">
                                <input type="date" class="form-control" name="dob" value="<?php echo $_SESSION['dob'] ?>" >
                                <input type="file" class="form-control" name="profile-image" accept="image/*">
                            </div>
                            <div class="row mt-4 mb-2">
                                <div class="col-12 col-md-3 mb-2">
                                    <button type="submit" name="save-profile" class="btn btn-primary w-100">Save</button>
                                </div>
                                <div class="col col-md-3">
                                    <a href="index.php">
                                        <div class="btn btn-light w-100 text-dark border">Cancel</div>
                                    </a>
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
</html>