<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            color: #333;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .product {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-image {
            width: 150px; /* Fixed width for the image container */
            height: 150px; /* Fixed height for the image container */
            overflow: hidden; /* Hide overflow to create square box */
            border-radius: 8px;
            margin: 0 auto 10px; /* Center image and add margin below */
        }

        .product-image img {
            width: 100%; /* Make the image fill the container */
            height: 100%; /* Make the image fill the container */
            object-fit: cover; /* Maintain aspect ratio and cover container */
        }

        .product h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .product p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .product a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .product a:hover {
            background-color: #0056b3;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .products-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Adjusted column width for smaller screens */
            }

            .product h3 {
                font-size: 14px; /* Adjusted heading font size */
            }

            .product p {
                font-size: 12px; /* Adjusted text font size */
            }

            .product a {
                padding: 6px 12px; /* Adjusted button padding */
            }
        }
    </style>
</head>
<body>
    <h2>Welcome to Mayiannie Beauty!</h2>
    
    <div class="products-container">
        <?php
        // Connect to database
        $conn = new mysqli("localhost", "root", "", "Mayiani");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch products from database
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display products in a grid layout
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<div class="product-image">';
                echo '<img src="../MayiannieAdmin/' . $row["image"] . '" alt="' . $row["title"] . '">';
                echo '</div>';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>Description: ' . $row["description"] . '</p>';
                echo '<p>Price: $' . $row["price"] . '</p>';
                echo '<a href="product_details.php?id=' . $row["product_id"] . '">View Details</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No products available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
