<?php
header('Content-Type: application/json'); // Ensure the response is in JSON format

try {
    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=shop_database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if complaint ID is provided and is a valid number
    if (isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])) {
        $complaintId = (int) $_POST['id']; // Ensure ID is an integer

        // Check if the complaint ID exists in the database
        $checkStmt = $pdo->prepare("SELECT id FROM complaint WHERE id = :id");
        $checkStmt->execute([':id' => $complaintId]);

        if ($checkStmt->rowCount() > 0) {
            // Update the complaint status to 'resolved'
            $stmt = $pdo->prepare("UPDATE complaint SET status = 'resolved' WHERE id = :id");
            $stmt->execute([':id' => $complaintId]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                // Fetch all complaints to regenerate the JSON file
                $result = $pdo->query("SELECT name, number, product_name, product_type, complaint, state, rating, status FROM complaint")->fetchAll(PDO::FETCH_ASSOC);

                // Update the JSON file
                if (file_put_contents('complaints.json', json_encode($result, JSON_PRETTY_PRINT)) === false) {
                    echo json_encode(['success' => false, 'message' => 'Failed to update complaints JSON file']);
                    exit;
                }

                // Respond with success
                echo json_encode(['success' => true, 'message' => 'Complaint status updated successfully']);
            } else {
                // Respond if the update didn't affect any rows (i.e., no change)
                echo json_encode(['success' => false, 'message' => 'Complaint status was already resolved or no changes made']);
            }
        } else {
            // Respond if no complaint with that ID is found
            echo json_encode(['success' => false, 'message' => 'Complaint ID not found']);
        }
    } else {
        // Respond if complaint ID is not valid or missing
        echo json_encode(['success' => false, 'message' => 'Valid Complaint ID is required']);
    }
} catch (PDOException $e) {
    // Handle any database exceptions or errors
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
