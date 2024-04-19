<?php
session_start();
include 'db_connect.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

  
    $sql = "SELECT * FROM profile WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $db_username = $row["username"];
        $db_password = $row["password"];

   
        if ($password === $db_password) {
           
            $_SESSION['admin_username'] = $db_username;
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
            exit(); 
        } else {
         
            header("Location: admin_login.php?error=invalid_credentials");
            exit(); 
        }
    } else {
        
        header("Location: admin_login.php?error=admin_not_found");
        exit(); 
    }
}

header("Location: admin_login.php");
exit(); // Exit if form is not submitted
?>
