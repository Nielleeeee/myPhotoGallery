<?php

if (isset($_POST["submit"])){
    
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $passwordrpt = $_POST["pwdrepeat"];

    require_once 'dbh.php';
    require_once 'component.php';

    if (emptyInputSignup($firstname, $lastname, $email, $password, $passwordrpt) !== false){
        header("location: signup.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false){
        header("location: signup.php?error=invalidemail");
        exit();
    }

    if (passwordMatch($password, $passwordrpt) !== false){
        header("location: signup.php?error=passworddontmatch");
        exit();
    }

    if (emailExist($conn, $email) !== false){
        header("location: signup.php?error=emailalreadytaken");
        exit();
    }

    if (invalidPassword($password) !== false){
        header("location: signup.php?error=invalidpassword");
        exit();
    }

    createUser($conn, $firstname, $lastname, $email, $password);

}else{
    header("location: signup.php");
    exit();   
}