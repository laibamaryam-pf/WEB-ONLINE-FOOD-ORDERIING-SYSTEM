<?php
include '../includes/auth_check.php';
include '../config/db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM cart WHERE id=$id");

header("Location: cart.php");
exit;
?>