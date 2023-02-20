<?php

$serverName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'illustra';
$port = 3307;

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, $port);

if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}