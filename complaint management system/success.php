<?php
if (isset($_GET['purchaseID'])) {
    $purchaseID = htmlspecialchars($_GET['purchaseID']);
    echo "
    <div style='
        font-family: Arial, sans-serif; 
        margin: 50px auto; 
        text-align: center; 
        background: rgba(159, 200, 227, 0.9); 
        padding: 20px; 
        border-radius: 8px; 
        width: 80%; 
        max-width: 500px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
        <h2 style='color:rgb(250, 8, 3);'>Success!</h2>
        <h1 style='font-size: 18px;'>Thank you for Shopping! Your Purchase ID: <strong>$purchaseID</strong></h1>
        <a href='shop.html' style='
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;'>Back to Shop</a>
    </div>";
} else {
    echo "
    <div style='
        font-family: Arial, sans-serif; 
        margin: 50px auto; 
        text-align: center; 
        background: rgba(31, 178, 211, 0.9); 
        padding: 20px; 
        border-radius: 8px; 
        width: 80%; 
        max-width: 500px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
        <h2 style='color: red;'>Error</h2>
        <p style='font-size: 18px;'>No Purchase ID provided.</p>
        <a href='shop.html' style='
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color:rgb(18, 234, 29);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;'>Back to Shop</a>
    </div>";
}
?>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: url('pur1.png') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }
</style>









