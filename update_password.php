<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the profile table
    $update_sql = "UPDATE profile SET password = '$hashed_password', reset_token = NULL WHERE reset_token = '$token'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Password updated successfully";
        // Redirect to the login page
        header("Location: admin_login.php");
        exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

?>
