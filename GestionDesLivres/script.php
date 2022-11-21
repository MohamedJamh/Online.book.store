<?php

    include('database.php');
    session_start();

    //routting
    if(isset($_POST['login'])) log_in();
    if(isset($_POST['logout'])) log_out();
    if(isset($_POST['signup'])) sign_up();
    if(isset($_POST['save-profile'])) save_profile();
    if(isset($_POST['add-book'])) add_book();
    if(isset($_GET['id'])) book_overview();


    function book_overview(){
        global $cnx;
        global $book_title , $book_autor , $book_description , $book_cover_path , $book_price , $book_available , $book_sold , $book_categorie;
        $id_book = $_GET['id'];
        $book_query = "SELECT `title`, `author`, `description`, `book_cover`, `price`, `available`, `sold` `id_categorie` FROM `book` WHERE `id_book` = $id_book";
        $result = mysqli_query($cnx,$book_query);
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['book_title'] = $row['title'];
            $_SESSION['book_title'] = $row['title'];
            $_SESSION['book_title'] = $row['title'];
            $_SESSION['book_title'] = $row['title'];
        }
        header('location: book-overview.php');
    }
    function empty_user_input(){
        if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['dob']) || empty($_POST['adresse']) || empty($_POST['confirm_password']) ){
            return true;
        }
        return false;
    }
    function sign_up(){
        if(empty_user_input()){
            //return message with session to fill all inputs
        }else{
            global $cnx;
            $f_name = strip_tags($_POST['first_name']);
            $l_name = strip_tags($_POST['last_name']);
            $date_naissance = strip_tags($_POST['dob']);
            $adresse = strip_tags($_POST['adresse']);
            $password = strip_tags($_POST['confirm_password']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "SELECT * FROM `admin` WHERE `email` LIKE '$adresse'";
            $check_email_query = mysqli_query($cnx,$query);

            if(mysqli_num_rows($check_email_query) > 0){
                //return message with session to use another email
            }else{
                $req = "INSERT INTO `admin`(`first_name`, `last_name`, `dateNaissance`, `email`, `password`) 
                VALUES ('$f_name','$l_name','$date_naissance','$adresse','$hashed_password')";
                mysqli_query($cnx,$req);
            }
        }
    }
    function log_in(){

        global $cnx;

        $adresse = strip_tags($_POST['adresse']);
        $password = strip_tags($_POST['password']);
        $login_query = "SELECT * FROM `admin` WHERE `email` LIKE '$adresse'";
        $login_result = mysqli_query($cnx,$login_query);

        if(mysqli_num_rows($login_result) > 0){
            while($row = mysqli_fetch_assoc($login_result)){
                if(password_verify($password,$row['password'])){

                    $_SESSION['id_admin'] = $row['id_admin'];
                    $_SESSION['f_name'] = $row['first_name'];
                    $_SESSION['l_name'] = $row['last_name'];
                    $_SESSION['dob'] = $row['dateNaissance'];
                    if(empty($row['profile_picture'])){
                        $_SESSION['thumbnail'] = "";
                    }else{
                        $_SESSION['thumbnail'] = $row['id_admin'] . ".jpg";
                    }

                    header('location: index.php');
                }
            }
        }else{
            // return message with session that adress is wrong
        }


    }
    function save_profile(){
        global $cnx;
        
        if(empty($_POST['f_name']) || empty($_POST['l_name']) || empty($_POST['dob'])){
            //return message with session to fill all inputs
        }else{
            $id_admin = $_SESSION['id_admin'];
            $f_name = strip_tags($_POST['f_name']);
            $l_name = strip_tags($_POST['l_name']);
            $date_naissance = strip_tags($_POST['dob']);

            $_SESSION['f_name'] = $f_name;
            $_SESSION['l_name'] = $l_name;
            $_SESSION['dob'] = $date_naissance;

            extract($_FILES['profile-image']);

            $image_path_info = explode('.',$name);
            $image_ext = strtolower(end($image_path_info));
            $allowed_ext = array('jpg','png' , 'jpeg');
            $image_new_path = "./assets/img/profile-thumbnail/";

            if($name == ""){
                $image_new_path = $image_new_path . $id_admin . ".jpg";
            }else{
                if(in_array($image_ext,$allowed_ext)){
                    if($error == 0){
                        $image_new_path = './assets/img/profile-thumbnail/'. $id_admin . '.jpg';
                        move_uploaded_file($tmp_name,$image_new_path);
                        
                        $_SESSION['thumbnail'] = $id_admin . ".jpg";
                        
                    }else{
                        //return message with session that something went wrong
                    }
                }else{
                    //return message with session to select another type
                }
            }
            $req = "UPDATE `admin` SET `first_name`='$f_name',`last_name`='$l_name',`dateNaissance`='$date_naissance',`profile_picture`='$image_new_path' 
            WHERE `id_admin`='$id_admin'";
            mysqli_query($cnx,$req);
        }
    }
    function generate_categories(){
        global $cnx;
        $cat_query = "SELECT `id_categorie`, `name_categorie` FROM `categorie`";
        $cat_result = mysqli_query($cnx,$cat_query);
        if(mysqli_num_rows($cat_result) > 0){
            while($row = mysqli_fetch_assoc($cat_result)){
                $id_cat = $row['id_categorie'];
                $name_cat = $row['name_categorie'];
                echo "<option value='$id_cat'>$name_cat</option>";
            }
        }
    }
    function add_book(){

        extract($_FILES['book-cover']);
        if(empty($_POST['title']) || empty($_POST['autor']) || empty($_POST['description']) || empty($_POST['categorie']) || empty($name) || empty($_POST['price']) || empty($_POST['available']) || empty($_POST['sold'])){
            //return error with session to fill all inputs
            echo 'empty';
        }else{
            global $cnx;

            $cover_path_info = explode('.',$name);
            $cover_ext = strtolower(end($cover_path_info));
            $allowed_ext = array('jpg','png' , 'jpeg');
            
            if($error == 0){
                if(in_array($cover_ext,$allowed_ext)){

                    $id_book = 0;
                    $title = $_POST['title'];
                    $autor = $_POST['autor'];
                    $description = $_POST['description'];
                    $categorie = $_POST['categorie'];
                    $price = $_POST['price'];
                    $available = $_POST['available'];
                    $sold = $_POST['sold'];
                    $id_admin = $_SESSION['id_admin'];

                    $book_query = "INSERT INTO `book`(`title`, `author`, `description`, `book_cover`, `price`, `available`, `sold`, `id_admin`, `id_categorie`) 
                    VALUES ('$title','$autor','$description','','$price','$available','$sold','$id_admin','$categorie')";
                    mysqli_query($cnx,$book_query);

                    $max_query = "SELECT MAX(`id_book`) FROM `book`";
                    $resault = mysqli_query($cnx,$max_query);
                    while($row = mysqli_fetch_array($resault)){
                        $id_book = $row[0];
                    }

                    $cover_query = "UPDATE `book` SET `book_cover`='$id_book.jpg' WHERE `id_book` = $id_book";
                    mysqli_query($cnx,$cover_query);

                    $cover_new_path = './assets/img/books/'. $id_book . '.jpg';
                    move_uploaded_file($tmp_name,$cover_new_path);
                }else{
                    //return message with session to select another type
                    echo 'another type';
                }
            }else{
                //return message with session that something went wrong
                    echo 'error';
            }

        }
    }
    function display_books(){
        global $cnx;
        $books_query = "SELECT `id_book`,`book_cover` , `description` FROM `book`";
        $resault = mysqli_query($cnx,$books_query);
        if(mysqli_num_rows($resault) > 0){
            while($row = mysqli_fetch_assoc($resault)){
                $id_book = $row['id_book'];
                $book_cover = $row['book_cover'];
                $description = $row['description'];
                echo "
                    <div class='card book overflow-hidden' style='max-width: 200px;'>
                        <a href='script.php?id=$id_book'>
                            <img src='./assets/img/books/$book_cover' class='card-img-top img-fluid' alt='book $description'>
                        </a>
                    </div>
                ";
            }
        }
    }
    function log_out(){
        unset($_SESSION['id_admin']);
        session_destroy();
        header('location:login.php');
    }
?>
