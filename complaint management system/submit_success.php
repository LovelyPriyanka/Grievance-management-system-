<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: complaint_login.html");
    exit();
}

try {
    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=shop_database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];  // Get email address from the form
    $number = $_POST['number'];
    $productName = $_POST['product_name'];
    $productType = $_POST['product_type'];
    $complaint = $_POST['complaint'];
    $state = $_POST['state'];
    $rating = $_POST['rating'];

    // Insert data into the database (with email)
    $stmt = $pdo->prepare("INSERT INTO complaint (name, email, number, product_name, product_type, complaint, state, rating, status)
                           VALUES (:name, :email, :number, :product_name, :product_type, :complaint, :state, :rating, 'pending')");
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':number' => $number,
        ':product_name' => $productName,
        ':product_type' => $productType,
        ':complaint' => $complaint,
        ':state' => $state,
        ':rating' => $rating
    ]);

    // Fetch all complaints
    $result = $pdo->query("SELECT name, email, number, product_name, product_type, complaint, state, rating, status FROM complaint")->fetchAll(PDO::FETCH_ASSOC);

    // Save complaints to a JSON file
    file_put_contents('complaints.json', json_encode($result, JSON_PRETTY_PRINT));

    // Success message display with "Done" button
    echo "
    <html>
    <head>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: lightpink;
                font-family: Arial, sans-serif;
            }
            .success-container {
                text-align: center;
                background-color: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .success-container .tick {
                font-size: 80px;
                color: green;
                margin-bottom: 20px;
            }
            .success-container h1 {
                font-size: 24px;
                color: #333;
                margin: 0;
            }
            .success-container p {
                font-size: 16px;
                color: #555;
            }
            .success-container .done-button {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class='success-container'>
            <div class='tick'>&#10004;</div>
            <h1>Complaint Submitted Successfully!</h1>
            <p>Thank you for your feedback.</p>
            <a href='shop.html' class='done-button'>Done</a>
        </div>
    </body>
    </html>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


