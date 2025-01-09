<?php
// Database connection parameters
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'shop_database';
$port = 3306;

// Create a new database connection
$conn = new mysqli($host, $user, $password, $database, $port);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the `customers` table
$sql = "SELECT id, name, phone, email, purchaseID, created_at FROM customers";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        p {
            color: #555;
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px auto;
            display: block;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Title -->
    <h1>DETAILS OF CUSTOMERS IN WEB SHOPPING</h1>

    <?php
    // Display results
    if ($result->num_rows > 0) {
        echo "
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Purchase ID</th>
                <th>Created At</th>
            </tr>";
        
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['purchaseID']) . "</td>
                    <td>" . htmlspecialchars($row['created_at']) . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No customers found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>

    <!-- Back button -->
    <div>
        <button onclick="window.location.href='admin_dashboard.php'">Back</button>
    </div>
</body>
</html>





