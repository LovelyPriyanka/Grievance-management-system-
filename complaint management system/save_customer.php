<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data and sanitize it
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    // Validate the input data (e.g., email format, phone length)
    if (empty($name) || empty($phone) || empty($email)) {
        echo "Please fill in all fields.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    if (strlen($phone) < 10) {
        echo "Phone number is too short.";
        exit();
    }

    // Generate a unique Purchase ID
    $purchaseID = "P" . date("YmdHis") . rand(10, 999);

    // Database connection
    $conn = new mysqli('127.0.0.1', 'root', '', 'shop_database', 3306);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO customers (name, phone, email, purchaseID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $email, $purchaseID);

    if ($stmt->execute()) {
        // Redirect to a confirmation page with success message
        header("Location: success.php?purchaseID=$purchaseID");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>








