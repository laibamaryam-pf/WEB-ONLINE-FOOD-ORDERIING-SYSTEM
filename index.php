<?php
include '../includes/auth_check.php';
include '../config/db.php';

$result = $conn->query("SELECT * FROM food");
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="header">
    <div>🍔 Food Ordering</div>
    <div>
        Welcome <?php echo $_SESSION['name']; ?>
        <a href="../auth/logout.php">Logout</a>
    </div>
</div>

<h2>Our Menu</h2>

<div class="menu-container">

<?php while($row = $result->fetch_assoc()){ ?>

<div class="food-card">

    <img src="../assets/images/<?php echo $row['image']; ?>">

    <h3><?php echo $row['name']; ?></h3>

    <p>Rs <?php echo $row['price']; ?></p>

    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">
        Add to Cart
    </a>

</div>

<?php } ?>

</div>