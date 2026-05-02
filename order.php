<?php
include '../includes/admin_check.php';
include '../config/db.php';

$sql = "SELECT orders.*, users.name 
        FROM orders 
        JOIN users ON orders.user_id = users.id
        ORDER BY orders.id DESC";

$result = $conn->query($sql);

if(!$result){
    die("Query Error: " . $conn->error);
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<!-- HEADER / BACK NAV -->
<div class="header">
    <div><b>Admin Panel</b></div>
    <div>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="foods.php">🍔 Foods</a>
        <a href="../auth/logout.php">🚪 Logout</a>
    </div>
</div>

<div class="admin-container">

<h2>All Orders</h2>

<table class="admin-table">

<tr>
    <th>Order ID</th>
    <th>User</th>
    <th>Total</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php
if($result->num_rows == 0){
    echo "<tr><td colspan='5'>No orders found</td></tr>";
}
?>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['total_price']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
      <td>
        <a class="edit-btn" href="order_details.php?id=<?php echo $row['id']; ?>">
            View Details
        </a>
      <br>
       <br>
   <a class="edit-btn" href="/foodordering/admin/update_status.php?id=<?php echo $row['id']; ?>&status=processing">
    Processing
</a>

<a class="edit-btn" href="/foodordering/admin/update_status.php?id=<?php echo $row['id']; ?>&status=delivered">
    Delivered
</a> 
    </td>
</tr>

<?php } ?>

</table>

<br>

<a class="back-btn" href="dashboard.php">⬅ Back to Dashboard</a>

</div>