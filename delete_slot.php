<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $slot_id = $_GET['id'];

    // Prepare and bind the delete statement
    $sql_delete = "DELETE FROM slots WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $slot_id);

    if ($stmt->execute()) {
        // Redirect back to the slot management page
        header("Location: ParkingSlot.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
