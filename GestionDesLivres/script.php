<?php

    include('database.php');
    session_start();

    //routting
    if(isset($_POST['login'])) log_in();
    if(isset($_POST['signup'])) sign_up();

    function empty_user_input(){
        if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['dob']) || empty($_POST['adresse']) || empty($_POST['confirm_password']) ){
            return true;
        }
        return false;
    }

    function log_in(){

        if(empty_user_input()){
            //return message with session
        }else{

        }


        header('location: index.php');
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

            $req = "SELECT * FROM `admin` WHERE `email` LIKE '$adresse'";
            $check_email_query = mysqli_query($cnx,$req);

            if(mysqli_num_rows($check_email_query) > 0){
                //return message with session to use another email
            }else{
                $req = "INSERT INTO `admin`(`first_name`, `last_name`, `dateNaissance`, `email`, `password`) 
                VALUES ('$f_name','$l_name','$date_naissance','$adresse','$hashed_password')";
                mysqli_query($cnx,$req);
                unset($_POST);
            }
        }
    }
?>
