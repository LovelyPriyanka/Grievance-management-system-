<?php
session_start();
session_destroy(); // Destroy the session
header("Location: worker_login.php"); // Redirect to login page after logout
exit();
?>

