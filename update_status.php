<?php
include '../includes/admin_check.php';
include '../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

if($id == 0 || $status == ''){
    die("Invalid request");
}

$status = $conn->real_escape_string($status);

$conn->query("
UPDATE orders 
SET status='$status' 
WHERE id=$id
");

header("Location: order.php");
exit;
?>