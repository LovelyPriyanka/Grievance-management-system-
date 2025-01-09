<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: complaint_login.html");
    exit();
}

try {
    // Database connection with error handling
    $pdo = new PDO("mysql:host=localhost;dbname=shop_database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if complaint ID is provided
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Retrieve complaint ID from the request and sanitize input
        $complaintId = (int)$_POST['id']; // Ensure complaint ID is an integer

        // Fetch complaint details (including email) based on ID
        $stmt = $pdo->prepare("SELECT name, email, status FROM complaint WHERE id = :id");
        $stmt->execute([':id' => $complaintId]);
        $complaint = $stmt->fetch(PDO::FETCH_ASSOC);

        // If complaint found and its status is 'pending'
        if ($complaint) {
            if ($complaint['status'] === 'resolved') {
                echo json_encode(['success' => false, 'message' => 'This complaint has already been resolved.']);
                exit();
            }

            // Update complaint status to 'resolved'
            $updateStmt = $pdo->prepare("UPDATE complaint SET status = 'resolved' WHERE id = :id");
            $updateStmt->execute([':id' => $complaintId]);

            // Send email to user about the resolution
            $to = $complaint['email'];
            $subject = "Your Complaint Has Been Resolved";
            $message = "Dear " . $complaint['name'] . ",\n\nYour complaint has been resolved. Thank you for your patience.\n\nBest regards,\nSupport Team";
            $headers = "From: support@shop.com" . "\r\n" .
                       "Reply-To: support@shop.com" . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            // Send email and check if it was successful
            if (mail($to, $subject, $message, $headers)) {
                echo json_encode(['success' => true, 'message' => 'Complaint resolved and email sent successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Complaint resolved but failed to send email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Complaint ID not found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Complaint ID is required']);
    }
} catch (PDOException $e) {
    // Catch any database-related errors
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Catch general errors
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>

