<?php
session_start();

// Database connection
$conn = new mysqli("localhost:3307", "root", "", "shop_database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Query to verify worker
$sql = "SELECT * FROM workers WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Valid credentials
    $_SESSION['worker_logged_in'] = true;
    $_SESSION['worker_username'] = $username;
    header("Location: worker_dashboard.php");
} else {
    // Invalid credentials
    header("Location: worker_login.php?error=1");
}

$conn->close();
?>
