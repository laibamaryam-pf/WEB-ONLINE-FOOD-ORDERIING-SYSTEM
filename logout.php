<?php
session_start();

// saari session values remove
session_unset();

// session destroy
session_destroy();

// login page par redirect
header("Location: login.php");
exit;
?>