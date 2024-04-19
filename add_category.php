<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_category = $_POST['Vehicle_category'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    // Insert the new category into the database
    $sql = "INSERT INTO categories (vehicle_category, created_at, updated_at) VALUES ('$vehicle_category', '$created_at', '$updated_at')";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the category management page
        header("Location: VehicleCategory.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if a category is being deleted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the category from the database
    $delete_sql = "DELETE FROM categories WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        // Reset the auto-increment value to the next available ID
        $reset_sql = "ALTER TABLE categories AUTO_INCREMENT = (SELECT MAX(id) + 1 FROM categories)";
        if ($conn->query($reset_sql) === FALSE) {
            echo "Error resetting auto-increment: " . $conn->error;
        }

        // Redirect back to the category management page
        header("Location: VehicleCategory.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Arrange items in a column */
            margin-bottom: 20px;
        }
        .header a {
            align-self: flex-start; /* Align the "Back" button to the left */
            margin-bottom: 10px; /* Add some space below the "Back" button */
            color: white; /* Green color for the "Back" button */
            text-decoration: none; /* Remove underline */
            padding: 5px 10px; /* Padding for the button */
            background-color: green; /* Green background for the "Back" button */
            border: none; /* Remove border */
            cursor: pointer; /* Add cursor pointer */
            border-radius: 4px; /* Add border radius */
            display: inline-block; /* Make it inline block */
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 5px;
            width: 200px;
        }
        button {
            padding: 5px 10px;
            background-color: green; /* Green background for the "Add" button */
            color: white; /* White text color for the "Add" button */
            border: none; /* Remove border */
            cursor: pointer; /* Add cursor pointer */
            border-radius: 4px; /* Add border radius */
            display: inline-block; /* Make it inline block */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Add Vehicle Category</h1>
        <a href="VehicleCategory.php">Back</a>
    </div>
    <form method="post">
        <label for="Vehicle_category">Vehicle Category:</label>
        <input type="text" id="Vehicle_category" name="Vehicle_category" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>

