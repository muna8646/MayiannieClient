<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        /* Basic CSS styling */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: wheat; /* Light background color */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-details {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px; /* Set fixed width for the product details box */
            box-sizing: border-box; /* Include padding in width calculation */
            margin: 0 auto 20px; /* Center horizontally and add bottom margin */
            background-color: #fff; /* White background */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        .product-details img {
            max-width: 100%; /* Ensure image does not exceed container width */
            height: auto; /* Maintain image aspect ratio */
            margin-bottom: 10px; /* Space below image */
            border-radius: 4px; /* Rounded image corners */
        }

        .product-details h3,
        .product-details p {
            margin: 0; /* Remove default margin */
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px; /* Space above button */
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Product Details</h2>
    </div>

    <?php
    // Retrieve product details based on product ID from URL parameter
    if (isset($_GET["id"])) {
        $product_id = $_GET["id"];

        // Connect to database
        $conn = new mysqli("localhost", "root", "", "Mayiani");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch product details
        $sql = "SELECT * FROM products WHERE product_id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<div class="product-details">';
            echo '<h3>' . $row["title"] . '</h3>';
            
            // Construct the image path for display
            $imagePath = '../MayiannieAdmin/' . $row["image"];
            echo '<img src="' . $imagePath . '" alt="' . $row["title"] . '">';
            
            echo '<p>Description: ' . $row["description"] . '</p>';
            echo '<p>Price: $' . $row["price"] . '</p>';
            echo '<a href="appointment.php?id=' . $row["product_id"] . '">Book Appointment</a>';
            echo '</div>';
        } else {
            echo "Product not found.";
        }

        $conn->close();
    } else {
        echo "Invalid product ID.";
    }
    ?>
    
    <div class="back-btn">
        <a href="index.php">Back to Homepage</a>
    </div>
</body>
</html>
