<?php
$servername = "localhost";
$dbname = "users";
$usersname = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=users",$usersname, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e){
    Echo "failed" . $e ->getMessage();
}

$con = new mysqli("localhost", "root", "", "users");

?>