<?php
session_start();

// Define the worker credentials (for testing purposes)
$worker_username = "worker";
$worker_password = "12345";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve entered credentials
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    // Validate credentials
    if ($entered_username === $worker_username && $entered_password === $worker_password) {
        $_SESSION['worker_logged_in'] = true;
        $_SESSION['worker_username'] = $worker_username; // Store the worker's username
        header('Location: worker_dashboard.php'); // Redirect to worker dashboard
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Login</title>
    <style>
        /* CSS to style the background and center the form */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('worker.png'); /* Replace 'worker.png' with the path to your image */
            background-size: cover; /* Ensure the image covers the entire screen */
            background-repeat: no-repeat; /* Prevent the image from repeating */
            background-position: center; /* Center the image */
            overflow: hidden; /* Prevent overflow */
        }

        .login-container {
            background-color: #f0f8ff; /* Light blue color */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Add shadow for better visibility */
            width: 300px;
            z-index: 10;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            text-align: center;
        }

        /* Styling for scrolling text */
        .scrolling-title {
            position: absolute;
            top: 10px;
            width: 100%;
            text-align: center;
            font-size: 3em;
            color: darkmagenta;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="scrolling-title">
        <marquee behavior="scroll" direction="left" scrollamount="8">WORKER LOGIN IN GRIEVANCES</marquee>
    </div>

    <div class="login-container">
        <h2>Worker Login</h2>

        <?php
        // Display error message if login failed
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>

