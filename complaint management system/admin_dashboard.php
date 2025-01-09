<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_login.php'); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(189, 114, 172);
            margin: 0;
            padding: 0;
        }

        /* Scrollable Heading Style */
        .scrolling-title {
            position: absolute;
            top: 10px;
            width: 100%;
            text-align: center;
            font-size: 4em;
            font-weight: bold;
            color: darkred;
        }

        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .logout:hover {
            background-color: #c0392b;
        }

        .container {
            text-align: center;
            margin: 150px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(47, 148, 4, 0.1);
            width: 60%;
        }

        button {
            padding: 10px 20px;
            font-size: 1.2em;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Scrolling Title -->
    <div class="scrolling-title">
        <marquee behavior="scroll" direction="left" scrollamount="8">ADMIN IN GRIEVANCE MANAGEMENT</marquee>
    </div>

    <!-- Logout Button -->
    <form action="logout.php" method="post" style="position: relative;">
        <button type="submit" class="logout">Logout</button>
    </form>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <button onclick="location.href='customer_details.php'">Customer Details</button>
        <div style="text-align: center; margin-top: 20px;">
            <button onclick="window.location.href='view_complaints.php'" 
                    style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                View Complaints
            </button>
        </div>
    </div>

</body>
</html>




