<?php
// view_complaints.php
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

    // Fetch all complaints
    $stmt = $pdo->query("SELECT id, name, email, number, product_name, complaint, status FROM complaint");
    $complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        h1 { text-align: center; color: #333; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; background-color: #fff; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color:rgb(212, 239, 125); }
        button { padding: 8px 16px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .resolved { color: green; }
        .pending { color: red; }
    </style>
</head>
<body>

    <h1>GRIEVANCES ON PRODUCTS</h1>

    <h2>Complaints</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Product Name</th>
                <th>Complaint</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($complaints as $complaint): ?>
                <tr>
                    <td><?php echo $complaint['name']; ?></td>
                    <td><?php echo $complaint['email']; ?></td>
                    <td><?php echo $complaint['number']; ?></td>
                    <td><?php echo $complaint['product_name']; ?></td>
                    <td><?php echo $complaint['complaint']; ?></td>
                    <td class="<?php echo $complaint['status'] === 'pending' ? 'pending' : 'resolved'; ?>">
                        <?php echo ucfirst($complaint['status']); ?>
                    </td>
                    <td>
                        <?php if ($complaint['status'] === 'pending'): ?>
                            <button onclick="resolveComplaint(<?php echo $complaint['id']; ?>)">Resolve</button>
                        <?php else: ?>
                            Resolved
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function resolveComplaint(complaintId) {
            // Send the complaint ID to the backend using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'resolve_complaint.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message);
                    location.reload(); // Reload the page to update the status
                } else {
                    alert(response.message);
                }
            };
            xhr.send('id=' + complaintId);
        }
    </script>

</body>
</html>




