<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];

    // Validate and sanitize data (e.g., use prepared statements to prevent SQL injection)

    // Connect to MySQL database
    $conn = new mysqli("localhost", "root", "", "Mayiani");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query
    $sql = "INSERT INTO appointments (product_id, name, email, phone, appointment_date) 
            VALUES ('$product_id', '$name', '$email', '$phone', '$date')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Appointment submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
?>
