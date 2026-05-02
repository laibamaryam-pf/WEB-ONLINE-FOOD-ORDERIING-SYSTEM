<?php
include '../includes/admin_check.php';
include '../config/db.php';
?>

<link rel="stylesheet" href="../assets/css/style.css">

<!-- HEADER (BACK OPTION FIX) -->
<div class="header">
    <div><b>Admin Panel</b></div>
    <div>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="foods.php">🍔 Manage Foods</a>
        <a href="../auth/logout.php">🚪 Logout</a>
    </div>
</div>

<div class="admin-form">

<h2>Add Food</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Food Name" required>

    <input type="number" name="price" placeholder="Price" required>

    <!-- CATEGORY -->
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php
        $cats = $conn->query("SELECT * FROM categories");
        while($c = $cats->fetch_assoc()){
            echo "<option value='{$c['id']}'>{$c['name']}</option>";
        }
        ?>
    </select>

    <input type="file" name="image" required>

    <button type="submit" name="add_food">Add Food</button>

</form>

</div>

<?php

if(isset($_POST['add_food'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../assets/images/" . $image);

    $sql = "INSERT INTO food (name, price, image, category_id)
            VALUES ('$name', '$price', '$image', '$category_id')";

    if($conn->query($sql)){

        // SUCCESS REDIRECT (IMPORTANT)
        echo "<script>
            alert('Food Added Successfully!');
            window.location.href='foods.php';
        </script>";

    } else {
        die("Error: " . $conn->error);
    }
}
?>