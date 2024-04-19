<?php
include 'db_connect.php';

// Check if form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $duration = $_POST['duration'];

    // Prepare and execute UPDATE query
    $sql = "UPDATE parking_duration SET duration=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $duration, $id);
    $stmt->execute();

    // Check if update was successful
    if($stmt->affected_rows > 0) {
        // Redirect back to the parking prices management page
        header("Location: parking_duration.php");
        exit();
    } else {
        echo "Error: Failed to update parking duration.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
