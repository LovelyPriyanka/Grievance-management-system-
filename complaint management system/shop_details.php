<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .product-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
        }
        .product-card img {
            max-width: 100%;
            border-radius: 8px 8px 0 0;
        }
        .product-card h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .product-card p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #666;
        }
        .product-card span {
            display: block;
            margin: 10px 0;
            font-weight: bold;
            color: #007bff;
        }
        .product-card button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-card button:hover {
            background-color: #218838;
        }
        #form-container {
            display: none;
            margin: 20px auto;
            width: 50%;
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #form-container h2 {
            text-align: center;
            color: #007bff;
        }
        form div {
            margin: 10px 0;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Shop Details</h1>
        <p>Explore our products below</p>
    </header>

    <div class="container">
        <div class="product-grid">
            <!-- Product Cards -->
            <div class="product-card">
                <img src="product1.jpg" alt="Product 1">
                <h3>Product 1</h3>
                <p>ID: P001</p>
                <span>Price: $50</span>
                <button onclick="showForm('Product 1', 'P001', '$50')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product2.jpeg" alt="Product 2">
                <h3>Product 2</h3>
                <p>ID: P002</p>
                <span>Price: $70</span>
                <button onclick="showForm('Product 2', 'P002', '$70')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product3.jpg" alt="Product 3">
                <h3>Product 3</h3>
                <p>ID: P003</p>
                <span>Price: $40</span>
                <button onclick="showForm('Product 3', 'P003', '$40')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product4.jpeg" alt="Product 4">
                <h3>Product 4</h3>
                <p>ID: P004</p>
                <span>Price: $60</span>
                <button onclick="showForm('Product 4', 'P004', '$60')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product5.jpeg" alt="Product 5">
                <h3>Product 5</h3>
                <p>ID: P005</p>
                <span>Price: $30</span>
                <button onclick="showForm('Product 5', 'P005', '$30')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product6.jpg" alt="Product 6">
                <h3>Product 6</h3>
                <p>ID: P006</p>
                <span>Price: $90</span>
                <button onclick="showForm('Product 6', 'P006', '$90')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product7.jpg" alt="Product 7">
                <h3>Product 7</h3>
                <p>ID: P007</p>
                <span>Price: $100</span>
                <button onclick="showForm('Product 7', 'P007', '$100')">Purchase</button>
            </div>
            <div class="product-card">
                <img src="product8.jpg" alt="Product 8">
                <h3>Product 8</h3>
                <p>ID: P008</p>
                <span>Price: $80</span>
                <button onclick="showForm('Product 8', 'P008', '$80')">Purchase</button>
            </div>
        </div>
    </div>

    <div id="form-container">
        <h2>Customer Details</h2>
        <form onsubmit="return submitPurchase()">
            <div>
                <label for="product-name">Product Name</label>
                <input type="text" id="product-name" readonly>
            </div>
            <div>
                <label for="product-id">Product ID</label>
                <input type="text" id="product-id" readonly>
            </div>
            <div>
                <label for="product-price">Price</label>
                <input type="text" id="product-price" readonly>
            </div>
            <div>
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" required>
            </div>
            <div>
                <label for="customer-email">Email</label>
                <input type="email" id="customer-email" required>
            </div>
            <div>
                <label for="customer-phone">Phone Number</label>
                <input type="tel" id="customer-phone" required>
            </div>
            <button type="submit">Purchase</button>
        </form>
    </div>

    <script>
        function showForm(name, id, price) {
            document.getElementById("form-container").style.display = "block";
            document.getElementById("product-name").value = name;
            document.getElementById("product-id").value = id;
            document.getElementById("product-price").value = price;
        }

        function submitPurchase() {
            alert("Purchase successful!");
            document.getElementById("form-container").style.display = "none";
            return false; // Prevent form submission for demo purposes
        }
    </script>
</body>
</html>










