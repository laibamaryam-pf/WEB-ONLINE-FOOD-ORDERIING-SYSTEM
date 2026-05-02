<?php
session_start();
include '../config/db.php';
?>

<link rel="stylesheet" href="../assets/css/style.css">

<body class="auth-page">

<div class="auth-box">

<h2>Register</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Enter Name" required>

    <input type="email" name="email" placeholder="Enter Email" required>

    <input type="password" name="password" placeholder="Enter Password" required>

    <button type="submit" name="register">Register</button>

</form>

<br>
<p>Already have an account? <a href="login.php">Login</a></p>

<?php

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($check->num_rows > 0){
        echo "<p style='color:red;'>Email already exists!</p>";
    }
    else{

        $role = "customer";

        $sql = "INSERT INTO users (name, email, password, role)
                VALUES ('$name', '$email', '$password', '$role')";

        if($conn->query($sql)){

            header("Location: login.php");
            exit;

        } else {
            echo "Error occurred!";
        }
    }
}
?>

</div>

</body>