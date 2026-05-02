<?php
session_start();
include '../config/db.php';
?>

<link rel="stylesheet" href="../assets/css/style.css">

<body class="auth-page">

<div class="auth-box">

<h2>Login</h2>

<form method="POST">

    <input type="email" name="email" placeholder="Enter Email" required>

    <input type="password" name="password" placeholder="Enter Password" required>

    <button type="submit" name="login">Login</button>

</form>

<br>
<p>Don't have an account? <a href="register.php">Create Account</a></p>

<?php

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){
                header("Location: ../admin/dashboard.php");
                exit;
            } else {
                header("Location: ../user/index.php");
                exit;
            }

        } else {
            echo "Wrong Password!";
        }

    } else {
        echo "User not found!";
    }
}
?>

</div>

</body>