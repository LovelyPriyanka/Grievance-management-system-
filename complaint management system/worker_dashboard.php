<?php
session_start();

// Check if worker is logged in
if (!isset($_SESSION['worker_logged_in']) || !$_SESSION['worker_logged_in']) {
    header("Location: worker_login.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieve worker username
$worker_username = $_SESSION['worker_username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: paleturquoise;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .button-container {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background-color:blue;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            margin: 10px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logout-button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($worker_username); ?>!</h1>
    <p>This is your dashboard.</p>
    
    <div class="button-container">
        <a href="view_complaints.php" class="button">Complaints</a>
        <a href="worker_logout.php" class="logout-button">Logout</a>
        <a href="view_resolved_complaints.php" class="button">Resolved Complaints</a>

    </div>
</body>
</html>



