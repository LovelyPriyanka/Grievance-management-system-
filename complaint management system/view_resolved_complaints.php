<?php
session_start();

// Check if worker is logged in
if (!isset($_SESSION['worker_logged_in']) || !$_SESSION['worker_logged_in']) {
    header("Location: worker_login.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieve worker username
$worker_username = $_SESSION['worker_username'];

// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=shop_database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all resolved complaints
    $stmt = $pdo->query("SELECT id, name, email, number, product_name, complaint, status FROM complaint WHERE status = 'resolved'");
    $resolvedComplaints = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolved Complaints</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: paleturquoise;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color:rgb(117, 221, 66);
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: blue;
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
    </style>
</head>
<body>
    <h1> RESOLVED COMPLAINTS IN GRIEVANCE</h1>
    <h1>Welcome, <?php echo htmlspecialchars($worker_username); ?>!</h1>
    <p>This is your resolved complaints section.</p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Product Name</th>
                <th>Complaint</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resolvedComplaints as $complaint): ?>
                <tr>
                    <td><?php echo htmlspecialchars($complaint['name']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['email']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['number']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['complaint']); ?></td>
                    <td class="resolved"><?php echo ucfirst($complaint['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="button-container">
        <a href="worker_dashboard.php" class="button">Back to Dashboard</a>
    </div>
</body>
</html>



