<?php
$host = "localhost:3307";
$user = "root";
$pass = "";
$db   = "foodordering";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Database Connection Failed: " . $conn->connect_error);
}
?>