<?php
// Include the header
include 'header.php';

// Include database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'signup') {
    // Get form data for signup
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $car = $_POST['car'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (username, password, email, car) VALUES ('$username', '$hashed_password', '$email', '$car')";
    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // If the form is not submitted properly, display an error message
    echo "Error: Form not submitted properly";
}
?>

