<?php
include '../includes/auth_check.php';
include '../config/db.php';

$user_id = $_SESSION['user_id'];

// get cart items
$cart = $conn->query("
SELECT cart.*, food.price 
FROM cart 
JOIN food ON cart.food_id = food.id 
WHERE cart.user_id = $user_id
");

$total = 0;
$items = [];

while($row = $cart->fetch_assoc()){
    $total += $row['price'] * $row['quantity'];
    $items[] = $row;
}

if(isset($_POST['place_order'])){

    // 1. insert order
    $conn->query("
        INSERT INTO orders (user_id, total_price, status)
        VALUES ($user_id, $total, 'pending')
    ");

    $order_id = $conn->insert_id;

    // 2. insert order_items (THIS WAS MISSING)
 foreach($items as $item){

    $food_id = (int)$item['food_id'];
    $qty = (int)$item['quantity'];
    $price = (float)$item['price'];

    $sql = "
        INSERT INTO order_items (order_id, food_id, quantity, price)
        VALUES ($order_id, $food_id, $qty, $price)
    ";

    $conn->query($sql) or die($conn->error);
}

    // 3. clear cart
    $conn->query("DELETE FROM cart WHERE user_id=$user_id");

    echo "<script>alert('Order Placed Successfully!'); window.location='index.php';</script>";
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="auth-box">

<h2>Checkout</h2>

<h3>Total: <?php echo $total; ?></h3>

<form method="POST">
    <input type="text" name="address" placeholder="Enter Address" required>
    <button type="submit" name="place_order">Place Order</button>
</form>

</div>