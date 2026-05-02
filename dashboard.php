<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    echo "Access Denied!";
    exit;
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="header">
    <div><b>Admin Panel</b></div>
    <div>
        Welcome <?php echo $_SESSION['name']; ?>
        <a href="../auth/logout.php">Logout</a>
    </div>
</div>

<h2>Admin Dashboard</h2>

<div class="menu-container">

    <div class="food-card">
        <h3>🍔 Foods</h3>
        <p>Manage Menu</p>
        <a href="foods.php">Go</a>
    </div>

    <div class="food-card">
        <h3> Add Food</h3>
        <p>Add new items</p>
        <a href="add_food.php">Go</a>
    </div>

    <div class="food-card">
        <h3>📦 Orders</h3>
        <p>View Orders</p>
        <a href="order.php">Go</a>
    </div>

</div>