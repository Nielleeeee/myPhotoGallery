<?php

function emptyInputSignup($firstname, $lastname, $email, $password, $passwordrpt){
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordrpt)){
        return true;
    }else {
        return false;
    }
}

function invalidEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else {
        return false;
    }
}

function passwordMatch($password, $passwordrpt){
    if ($password !== $passwordrpt){
        return true;
    }else {
        return false;
    }
}

function invalidPassword($password){
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{6,}$/', $password)){
        return true;
    }else {
        return false;
    }
}

function emailExist($conn, $email){
    $sql =  "SELECT * FROM `users` WHERE `email` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: signup.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createUser($conn, $firstname, $lastname, $email, $password){
    $sql =  "INSERT INTO `users` (firstname, lastname, email, password) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: signup.php?error=statementfailed");
        exit();
    }
    
    $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: signup.php?error=none");
    exit();
    
}   

function emptyLoginInput(){
    if (empty($email) || empty($password)){
        return false;
    }else {
        return true;
    }
}

function loginUser($conn, $email, $password){
    $emailExist = emailExist($conn, $email);

    if ($emailExist === false){
        header("location: Login.php?error=invalidlogin");
        exit();
    }

    $hashedpwd = $emailExist["password"];
    $checkpwd = password_verify($password, $hashedpwd);
    
    if ($checkpwd === false){ 
        header("location: Login.php?error=invalidlogin");
        exit();
    }
    else if ($checkpwd === true){
        session_start();
        $_SESSION["userID"] = $emailExist["userID"];    
        $_SESSION["email"] = $emailExist["email"];
        header("location: landingpage.php");
        exit();
    }
}