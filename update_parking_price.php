<?php
include 'db_connect.php';

// Check if form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Prepare and execute UPDATE query
    $sql = "UPDATE parking_prices SET category=?, duration=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $category, $duration, $price, $id);
    $stmt->execute();

    // Check if update was successful
    if($stmt->affected_rows > 0) {
        // Redirect back to the parking prices management page
        header("Location: parking_prices_management.php");
        exit();
    } else {
        echo "Error: Failed to update parking price.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
