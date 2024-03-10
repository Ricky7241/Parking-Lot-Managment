<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
      
        $admin_username = "admin";
        $admin_password = "admin123";

         //
        $entered_username = $_POST["username"];
        $entered_password = $_POST["password"];

         
        if ($entered_username === $admin_username && $entered_password === $admin_password) {
          
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
