<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/admin_check.php';
include '../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id == 0){
    die("Invalid ID");
}

// fetch data
$result = $conn->query("SELECT * FROM food WHERE id=$id");

if(!$result || $result->num_rows == 0){
    die("Food not found!");
}

$row = $result->fetch_assoc();

// update logic
if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    $oldImage = $row['image'];

    if(!empty($_FILES['image']['name'])){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $oldPath = "../assets/images/" . $oldImage;
        if(file_exists($oldPath)){
            unlink($oldPath);
        }

        move_uploaded_file($tmp, "../assets/images/" . $image);

    } else {
        $image = $oldImage;
    }

    $update = $conn->query("
        UPDATE food 
        SET name='$name', price='$price', image='$image'
        WHERE id=$id
    ");

    if($update){
        header("Location: foods.php");
        exit;
    } else {
        die("Update failed: " . $conn->error);
    }
}
?>

<!-- 🔥 CSS LINK (ADD THIS) -->
<link rel="stylesheet" href="../assets/css/style.css">

<!-- 🔥 WRAPPER START -->
<div class="admin-form">

<h2>Edit Food</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    
    <input type="number" name="price" value="<?php echo $row['price']; ?>" required>

    <p>Current Image:</p>
    <img src="../assets/images/<?php echo $row['image']; ?>" width="100">

    <input type="file" name="image">

    <button type="submit" name="update">Update Food</button>

</form>

</div>