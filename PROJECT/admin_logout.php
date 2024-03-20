<?php
// Start the session
session_start();

// Redirect to the login page if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Destroy the session variables
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Logout</title>
</head>
<body>
    <h1>SAARG Parking Solutions</h1>
    <p>You have successfully logged out of the system.</p>
    <a href="admin_login.php">Back to Admin Login</a>
</body>
</html>
