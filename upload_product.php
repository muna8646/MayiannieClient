<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        h2 {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Upload Product</h2>

    <?php
    session_start();

    // Check if admin is logged in
    if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $description = $_POST["description"];
            $price = $_POST["price"];

            // Specify the target directory for file uploads
            $targetDir = "uploads/";

            // Create the uploads directory if it doesn't exist
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true); // Recursive directory creation
            }

            // Check if file was uploaded successfully
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);

                // Move uploaded file to destination directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // File uploaded successfully, insert product details into database
                    $conn = new mysqli("localhost", "root", "", "Mayiani");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "INSERT INTO products (title, description, price, image) VALUES ('$title', '$description', '$price', '$targetFile')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Product uploaded successfully.</p>";
                    } else {
                        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                    }

                    $conn->close();
                } else {
                    echo "<p>Sorry, there was an error uploading your file.</p>";
                }
            } else {
                echo "<p>File upload error. Please try again.</p>";
            }
        } else {
            echo "<p>Invalid request method.</p>";
        }
    } else {
        // Redirect to admin login page if not logged in
        header("Location: admin_login.php");
        exit();
    }
    ?>

    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
