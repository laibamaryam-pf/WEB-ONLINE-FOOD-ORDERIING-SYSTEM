<?php
include '../includes/auth_check.php';
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$result = $conn->query("
SELECT cart.*, food.name, food.price, food.image
FROM cart
JOIN food ON cart.food_id = food.id
WHERE cart.user_id = $user_id
");

if(!$result){
    die("Query Error: " . $conn->error);
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="cart-container">

<h2>Your Cart</h2>

<table class="cart-table">

<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Action</th>
</tr>

<?php
$grand_total = 0;

while($row = $result->fetch_assoc()){

$total = $row['price'] * $row['quantity'];
$grand_total += $total;
?>

<tr>
    <td>
        <img src="../assets/images/<?php echo $row['image']; ?>" width="60">
    </td>

    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $total; ?></td>

    <td>
        <a class="remove-btn" href="remove_cart.php?id=<?php echo $row['id']; ?>">Remove</a>
    </td>
</tr>

<?php } ?>

</table>

<div class="grand-total">
    Grand Total: <?php echo $grand_total; ?>
</div>

<a class="checkout-btn" href="checkout.php">Proceed to Checkout</a>

<a class="back-link" href="index.php">⬅ Continue Shopping</a>