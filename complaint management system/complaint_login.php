<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Phone or Email
    $password = $_POST['password']; // Purchase ID

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'shop_database');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to find matching customer
    $sql = "SELECT * FROM customers WHERE (phone = ? OR email = ?) AND purchaseID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user is found
    if ($result->num_rows > 0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['purchaseID'] = $password;

        // Redirect to complaint form
        header("Location: complaint_form.php");
        exit();
    } else {
        // Login failed
        $error = "Invalid login credentials. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Login Failed</h1>
    <p class="error"><?php echo isset($error) ? $error : "Unknown error"; ?></p>
    <a href="complaint_login.html">Go Back to Login</a>
</body>
</html>

