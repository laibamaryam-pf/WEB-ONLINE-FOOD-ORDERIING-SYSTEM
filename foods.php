<?php
include '../includes/admin_check.php';
include '../config/db.php';

$result = $conn->query("SELECT * FROM food");
?>

<link rel="stylesheet" href="../assets/css/style.css">
<div class="header">
    <div><b>Admin Panel</b></div>

    <div>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="foods.php">🍔 Foods</a>
        <a href="../auth/logout.php">🚪 Logout</a>
    </div>
</div>
<div class="admin-container">

<h2>All Foods</h2>

<table class="admin-table">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Image</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['price']; ?></td>

    <td>
       <img src="../assets/images/<?php echo $row['image']; ?>" width="60">
    </td>

    <td>
        <a class="edit-btn" href="edit_food.php?id=<?php echo $row['id']; ?>">Edit</a>
   <a class="delete-btn"
   href="delete_food.php?id=<?php echo $row['id']; ?>" 
   onclick="return confirm('⚠ Are you sure you want to delete this food?');">
   Delete
</a>
    </td>
</tr>

<?php } ?>

</table>

</div>

