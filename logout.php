<?php
// Start session to access session variables
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to admin login page after logout
header("Location: admin_login.php");
exit();
?>
