<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with your admin credentials
    $admin_username = 'Priya';
    $admin_password = 'Priya123';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php'); // Redirect to dashboard
        exit();
    } else {
        $error = 'Invalid credentials. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('admin.png');
            background-color:rgb(27, 204, 178);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 1em;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            font-size: 1.2em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Admin Login</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

