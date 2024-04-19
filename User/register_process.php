<?php

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['name'], $_POST['username'], $_POST['password'], $_POST['address'])) {
    // Get form data for signup
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name']; 
    $address = $_POST['address']; 

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Get the current timestamp for created_at and updated_at fields
    $current_timestamp = date('Y-m-d H:i:s');

    $sql = "INSERT INTO users (username, password, email, name, address, created_at, updated_at) 
            VALUES ('$username', '$hashed_password', '$email', '$name', '$address', '$current_timestamp', '$current_timestamp')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: user_login.php");
        exit(); // Important to prevent further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: Form not submitted properly";
}
?>
