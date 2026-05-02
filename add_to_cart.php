<?php
include '../includes/auth_check.php';
include '../config/db.php';

session_start();
$user_id = $_SESSION['user_id'];
$food_id = $_GET['id'];
if($check->num_rows > 0){

    // already exists → quantity increase
    $conn->query("UPDATE cart 
    SET quantity = quantity + 1 
    WHERE user_id=$user_id AND food_id=$food_id");

}else{

    // new item
    $conn->query("INSERT INTO cart (user_id, food_id, quantity)
    VALUES ($user_id, $food_id, 1)");
}

header("Location: cart.php");
exit;
?>