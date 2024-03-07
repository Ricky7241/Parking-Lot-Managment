<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
      
        // Define admin users
        $admin_users = array(
            "admin" => "admin123",
            "admin2" => "admin123"
        );

        // Get entered credentials
        $entered_username = $_POST["username"];
        $entered_password = $_POST["password"];

        // Check if entered credentials match any admin user
        if (array_key_exists($entered_username, $admin_users) && $admin_users[$entered_username] === $entered_password) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            header("Location: admin_login.php?error=invalid_credentials");
            exit();
        }
    } else {
        header("Location: admin_login.php?error=missing_credentials");
        exit();
    }
} else {
    header("Location: admin_login.php");
    exit();
}
?>
