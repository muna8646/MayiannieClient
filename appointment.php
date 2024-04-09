<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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

        form {
            max-width: 400px; /* Set maximum width for the form */
            margin: 0 auto; /* Center-align the form horizontally */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff; /* White background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding in width calculation */
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-btn {
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
        <h2>Book Appointment</h2>
    </div>

    <?php
    // Retrieve product details based on product ID from URL parameter
    if (isset($_GET["id"])) {
        $product_id = $_GET["id"];

        // Display appointment booking form
        echo '<form action="submit_appointment.php" method="POST">';
        echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
        echo '<label for="name">Your Name:</label>';
        echo '<input type="text" id="name" name="name" required><br>';
        echo '<label for="email">Your Email:</label>';
        echo '<input type="email" id="email" name="email" required><br>';
        echo '<label for="date">Preferred Date:</label>';
        echo '<input type="date" id="date" name="date" required><br>';
        echo '<input type="submit" value="Submit Appointment">';
        echo '</form>';
    } else {
        echo "Invalid product ID.";
    }
    ?>
    
    <div class="back-btn">
        <a href="index.php">Back to Homepage</a>
    </div>
</body>
</html>
