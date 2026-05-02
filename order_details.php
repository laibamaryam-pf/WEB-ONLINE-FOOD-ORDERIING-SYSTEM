<?php
include '../includes/admin_check.php';
include '../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id == 0){
    die("Invalid Order ID");
}

$result = $conn->query("
SELECT 
    order_items.*,
    food.name,
    food.price AS food_price
FROM order_items
JOIN food ON order_items.food_id = food.id
WHERE order_items.order_id = $id
");

if(!$result){
    die("Query Error: " . $conn->error);
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="header">
    <div><b>Order Details</b></div>
    <div>
        <a href="order.php">⬅ Back to Orders</a>
    </div>
</div>

<div class="admin-container">

<h2>Order #<?php echo $id; ?> Details</h2>

<table class="admin-table">

<tr>
    <th>Food</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</tr>

<?php
$grand_total = 0;

if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        $total = $row['price'] * $row['quantity'];
        $grand_total += $total;
?>

<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['food_price']; ?></td>
    <td><?php echo $total; ?></td>
</tr>

<?php
    }

} else {
    echo "<tr><td colspan='4'>No items found in this order</td></tr>";
}
?>

</table>

<h3>Grand Total: <?php echo $grand_total; ?></h3>

</div>