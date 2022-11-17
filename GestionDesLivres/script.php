<?php
    include('database.php');

    //routting
    if(isset($_POST['login'])) log_in();
    if(isset($_POST['signup'])) sign_up();

    function log_in(){
        header('location: index.php');
    }
    function sign_up(){
        extract($_POST);
        
        header('location: login.php');
    }
?>
