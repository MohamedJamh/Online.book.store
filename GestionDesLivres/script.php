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
    if(isset($_POST['delete-book'])) delete_book();
    if(isset($_POST['update-book'])) update_book();


    function invalid($number){
        if($number = "" || $number < 0){
            return true;
        }
    }
    function book_overview(){
        global $cnx;
        global $book_title , $book_autor , $book_description , $book_cover_path , $book_price , $book_available , $book_sold , $book_categorie;
        $id_book = $_GET['id'];
        $book_query = "SELECT `title`, `author`, `description`, `book_cover`, `price`, `available`, `sold`, `id_categorie` FROM `book` WHERE `id_book` = $id_book";
        $result = mysqli_query($cnx,$book_query);
        while($row = mysqli_fetch_array($result)){
            $_SESSION['book_id'] = $id_book;
            $_SESSION['book_title'] = $row[0];
            $_SESSION['book_autor'] = $row[1];
            $_SESSION['book_description'] = $row[2];
            $_SESSION['book_cover_path'] = $row[3];
            $_SESSION['book_price'] = $row[4];
            $_SESSION['book_available'] = $row[5];
            $_SESSION['book_sold'] = $row[6];
            $_SESSION['book_categorie'] = $row[7];
        }
        header('location: book-overview.php');
    }
    function delete_book(){
        global $cnx;
        try {
            $id_book = strip_tags($_POST['book-id-overview']);
            $del_query = "DELETE FROM `book` WHERE `id_book` = $id_book";
            mysqli_query($cnx,$del_query);
            unlink("./assets/img/books/$id_book.jpg");
            header('location: index.php');
        } catch (\Throwable $th) {
            $GLOBALS['error-message'] = 'Sorrry Something Went Wrong ! ';
        }
    }
    function update_book(){
        global $cnx;
        try {
            if(empty($_POST['book-id-overview']) || empty($_POST['book-title-overview']) || empty($_POST['book-autor-overview']) || empty($_POST['book-description-overview']) || empty($_POST['book-categorie-overview']) || empty($_POST['book-price-overview']) || empty($_POST['book-available-overview']) || empty($_POST['book-sold-overview'])){
                $GLOBALS['error-message'] = 'Make Sure All Inpust Are Valid ! ';
            }else{
                global $cnx;
                extract($_FILES['book-cover-overview']);
                $id_book = $_POST['book-id-overview'];
                if(!empty($name)){
                    $cover_path_info = explode('.',$name);
                    $cover_ext = strtolower(end($cover_path_info));
                    $allowed_ext = array('jpg','png' , 'jpeg');
                    
                    if($error == 0){
                        if(in_array($cover_ext,$allowed_ext)){
    
                            $cover_new_path = './assets/img/books/'. $id_book . '.jpg';
                            move_uploaded_file($tmp_name,$cover_new_path);
    
                        }else{
                            $GLOBALS['error-message'] = 'Please Select Images Only ! ';
                        }
                    }else{
                        $GLOBALS['error-message'] = 'Sorrry Something Went Wrong ! ';
                    }
                }
    
                $title = $_POST['book-title-overview'];
                $autor = $_POST['book-autor-overview'];
                $description = $_POST['book-description-overview'];
                $categorie = $_POST['book-categorie-overview'];
                $price = $_POST['book-price-overview'];
                $available = $_POST['book-available-overview'];
                $sold = $_POST['book-sold-overview'];
    
                $_SESSION['book_title'] = $title;
                $_SESSION['book_autor'] = $autor;
                $_SESSION['book_description'] = $description;
                $_SESSION['book_price'] = $price;
                $_SESSION['book_available'] = $available;
                $_SESSION['book_sold'] = $sold;
                $_SESSION['book_categorie'] = $categorie;
    
                $book_query = "UPDATE `book` SET `title`='$title',`author`='$autor',`description`='$description',
                `price`='$price',`available`='$available',`sold`='$sold',`id_categorie`='$categorie' WHERE `id_book`=$id_book";
                mysqli_query($cnx,$book_query);

                categorie_earnings();
                $GLOBALS['message'] = 'Book Has Been Updated Successfully ! ';
            }
        } catch (\Throwable $th) {
            header('location:index.php');
        }
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
                $GLOBALS['error-message'] = 'Adresse Already Exist !';
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
                }else{
                    $GLOBALS['error-message'] = 'Adresse or Password is incorrect !';
                }
            }
        }else{
            $GLOBALS['error-message'] = 'Adresse or Password is incorrect !';
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
    function generate_categories($selected = NULL){
        global $cnx;
        $cat_query = "SELECT `id_categorie`, `name_categorie` FROM `categorie`";
        $cat_result = mysqli_query($cnx,$cat_query);
        if(mysqli_num_rows($cat_result) > 0){
            while($row = mysqli_fetch_assoc($cat_result)){
                $id_cat = $row['id_categorie'];
                $name_cat = $row['name_categorie'];
                if($id_cat == $selected){
                    echo "<option value='$id_cat' selected >$name_cat</option>";
                }else{
                    echo "<option value='$id_cat'>$name_cat</option>";
                }
            }
        }
    }
    function add_book(){

        extract($_FILES['book-cover']);
        if(empty($_POST['title']) || empty($_POST['autor']) || empty($_POST['description']) || empty($_POST['categorie']) || empty($name) || invalid($_POST['price']) || $_POST['price'] == 0 || invalid($_POST['available']) || invalid($_POST['sold'])){
            $GLOBALS['error-message'] = 'Make Sure All Inpust Are Valid ! ';
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

                    categorie_earnings();
                    header('location:index.php');
                }else{
                    $GLOBALS['error-message'] = 'Please Select Images Only ! ';
                }
            }else{
                $GLOBALS['error-message'] = 'Sorrry Something Went Wrong ! ';
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
                    <div class='card book overflow-hidden' style='max-width: 200px;height:max-content;'>
                        <a href='script.php?id=$id_book'>
                            <img src='./assets/img/books/$book_cover' class='card-img-top img-fluid' alt='book $description'>
                        </a>
                    </div>
                ";
            }
        }
    }
    function available_books_stats(){
        global $cnx;
        $query = "SELECT count(*) FROM `book`";
        $result = mysqli_query($cnx,$query);
        while($row = mysqli_fetch_array($result)){
            return $row[0];
        }
    }
    function sold_books_stats(){
        global $cnx;
        $sold_books = 0;
        $query = "SELECT `sold` FROM `book`";
        $result = mysqli_query($cnx,$query);
        while($row = mysqli_fetch_assoc($result)){
            $sold_books += $row['sold'];
        }
        return $sold_books;
    }
    function earnings_books_stats(){
        global $cnx;
        $earnings = 0;
        $query = "SELECT `price`,`sold` FROM `book`";
        $result = mysqli_query($cnx,$query);
        while($row = mysqli_fetch_assoc($result)){
            $earnings += $row['price'] * $row['sold'];
        }
        return $earnings;
    }
    function categorie_earnings(){
        global $cnx;
        $book_query = "SELECT `price`,`sold`,`id_categorie` FROM `book`";
        $categorie_query = "SELECT `id_categorie`FROM `categorie`";

        $book_result = mysqli_query($cnx,$book_query);
        $categorie_result = mysqli_query($cnx,$categorie_query);


        if(mysqli_num_rows($book_result) > 0 || mysqli_num_rows($categorie_result) > 0 ){
            while($categorie_row = mysqli_fetch_assoc($categorie_result)){
                $cat_earnings = 0;
                mysqli_data_seek($book_result,0);
                while($book_row = mysqli_fetch_assoc($book_result)){
                    if($categorie_row['id_categorie'] == $book_row['id_categorie']){
                        $cat_earnings += $book_row['price'] * $book_row['sold'];
                    }
                }
                $id_cat = $categorie_row['id_categorie'];
                $cat_earnings_query = "UPDATE `categorie` SET `earnings`='$cat_earnings' WHERE `id_categorie`='$id_cat'";
                mysqli_query($cnx,$cat_earnings_query);
            }
        }
    }
    function best_categorie_stats(){
        if(available_books_stats() != 0){
            global $cnx;
            $best_cat_query = "SELECT `name_categorie` from categorie WHERE `earnings` IN (SELECT MAX(earnings) from categorie)";
    
            $best_cat_result = mysqli_query($cnx,$best_cat_query);
            $best_cat_row = mysqli_fetch_array($best_cat_result);
            return $best_cat_row[0];
        }else{
            return '--';
        }
    }
    function log_out(){
        unset($_SESSION['id_admin']);
        session_destroy();
        header('location:login.php');
    }
?>
