<?php


// Include the header
include 'header.php';


// Include database connection

include 'db_connect.php';

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
