<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define admin credentials (replace with your own)
    $admin_username = "admin";
    $admin_password = "password";

    // Retrieve username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate admin credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Start session and store admin status
        session_start();
        $_SESSION["admin_logged_in"] = true;

        // Redirect to admin dashboard upon successful login
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Display error message if credentials are incorrect
        echo "Invalid username or password. Please try again.";
    }
}
?>
