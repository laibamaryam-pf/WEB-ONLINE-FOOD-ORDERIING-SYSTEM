<?php
include '../includes/admin_check.php';
include '../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id == 0){
    die("Invalid ID");
}

// get image first (optional safe delete)
$res = $conn->query("SELECT image FROM food WHERE id=$id");
$row = $res->fetch_assoc();

if($row){

    // delete image file
    $imgPath = "../assets/images/" . $row['image'];
    if(file_exists($imgPath)){
        unlink($imgPath);
    }

    // delete DB record
    $conn->query("DELETE FROM food WHERE id=$id");
}

// redirect back
header("Location: foods.php");
exit;
?>