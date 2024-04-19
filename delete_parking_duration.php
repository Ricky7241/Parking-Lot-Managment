<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = $_GET['id'];

    // Prepare and execute DELETE query
    $sql = "DELETE FROM parking_duration WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if deletion was successful
    if($stmt->affected_rows > 0) {
        // Redirect back to the parking prices management page
        header("Location: parking_duration.php");
        exit();
    } else {
        echo "Error: Failed to delete parking duration.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
