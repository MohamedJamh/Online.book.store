<?php
    try {
        global $cnx;
        $cnx = mysqli_connect('localhost','root','','youcodegestiondeslivres');
    }catch (Exception $e) {
        echo 'somthing went wrong : <br>' . $e;
        die();
    }
?>