<?php

if (isset($_POST["submit"])){

    $email = $_POST["email"];
    $password = $_POST["pwd"];

    require_once 'dbh.php';
    require_once 'component.php';

    if (emptyLoginInput($email, $password) !== false){
        header("location: Login.php?error=emptylogininput");
        exit();
    }

    loginUser($conn, $email, $password);
}else{
    header("location: Login.php");
    exit();
}