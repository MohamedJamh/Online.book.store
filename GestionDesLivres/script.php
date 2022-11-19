<?php

    include('database.php');
    session_start();

    //routting
    if(isset($_POST['login'])) log_in();
    if(isset($_POST['logout'])) log_out();
    if(isset($_POST['signup'])) sign_up();
    if(isset($_POST['save-profile'])) save_profile();

    function empty_user_input(){
        if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['dob']) || empty($_POST['adresse']) || empty($_POST['confirm_password']) ){
            return true;
        }
        return false;
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
                    header('location: index.php');
                }
            }
        }else{
            // return message with session that adress is wrong
        }


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

            $req = "UPDATE `admin` SET `first_name`='$f_name',`last_name`='$l_name',`dateNaissance`='$date_naissance' WHERE `id_admin`='$id_admin'";
            mysqli_query($cnx,$req);
        }
    }
    function log_out(){
        unset($_SESSION['id_admin']);
        session_destroy();
        header('location:login.php');
    }
?>
