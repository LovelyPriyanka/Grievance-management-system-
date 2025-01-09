<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: complaint_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lemonchiffon;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            color: limegreen;
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }
        input, textarea, select, button {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
        }
        .button-group button {
            width: 48%;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
        /* Marquee styling */
        .marquee {
           
            color: blue;
            padding: 10px 0;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
        }
    </style>
    <script>
        function validateForm(event) {
            const name = document.getElementById("name").value;
            const phoneNumber = document.getElementById("number").value;
            const productName = document.getElementById("product_name").value;
            const complaint = document.getElementById("complaint").value;
            const email = document.getElementById("email").value;

            const nameRegex = /^[a-zA-Z\s]+$/;
            const phoneRegex = /^[0-9]{10}$/;
            const productNameRegex = /^[a-zA-Z\s]+$/;
            const complaintRegex = /^[a-zA-Z0-9\s.,!?-]*$/;
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!nameRegex.test(name)) {
                alert("Name should only contain letters and spaces.");
                event.preventDefault();
                return false;
            }

            if (!phoneRegex.test(phoneNumber)) {
                alert("Phone number should contain only 10 digits.");
                event.preventDefault();
                return false;
            }

            if (!productNameRegex.test(productName)) {
                alert("Product name should only contain letters and spaces.");
                event.preventDefault();
                return false;
            }

            if (!complaintRegex.test(complaint)) {
                alert("Complaint description should only contain letters, numbers, and basic punctuation.");
                event.preventDefault();
                return false;
            }

            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

    <!-- Marquee -->
    <div class="marquee">
        <marquee behavior="scroll" direction="left">
            COMPLAINT FORM FOR GRIEVANCE
        </marquee>
    </div>

    <div class="container">
        <h1>Raise a Complaint</h1>
      
        <form action="submit_success.php" method="POST" onsubmit="return validateForm(event);">   
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            <div class="error-message" id="name-error"></div>
            
            <label for="number">Phone Number:</label>
            <input type="tel" id="number" name="number" placeholder="Enter your phone number starting with 9" required>
            <div class="error-message" id="number-error"></div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <div class="error-message" id="email-error"></div>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" placeholder="Enter the product name" required>
            <div class="error-message" id="product-name-error"></div>
            
            <label for="product_type">Product Type:</label>
            <select id="product_type" name="product_type" required>
                <option value="">Select product type</option>
                <option value="Electronics">Electronics</option>
                <option value="Clothing">Clothing</option>
                <option value="Home Appliances">Home Appliances</option>
                <option value="Other">Other</option>
            </select>
            
            <label for="complaint">Complaint Description:</label>
            <textarea id="complaint" name="complaint" rows="5" placeholder="Describe your complaint (letters, numbers, and basic punctuation)" required></textarea>
            <div class="error-message" id="complaint-error"></div>
            
            <label for="state">State:</label>
            <input type="text" id="state" name="state" placeholder="Enter your state" required>
            
            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="">Select a rating</option>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
            
            <div class="button-group">
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </div>
        </form>
    </div>

</body>
</html>



