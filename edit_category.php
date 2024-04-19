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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $category_id = $_POST['id'];
    $vehicle_category = $_POST['vehicle_category'];

    // Update the category in the database
    $sql = "UPDATE categories SET vehicle_category = '$vehicle_category' WHERE id = $category_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the category management page
        header("Location: VehicleCategory.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve the category details based on the ID from the database
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "SELECT id, vehicle_category FROM categories WHERE id = $category_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vehicle_category = $row['vehicle_category'];
    } else {
        echo "Category not found";
        exit();
    }
} else {
    echo "Category ID not provided";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vehicle Category</title>
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
        }
        form {
            margin-top: 20px;
        }
        input[type="text"] {
            padding: 5px;
            width: 200px;
        }
        .add-button, .back-button, .update-button {
            padding: 5px 10px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px; /* Rounded corners */
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
        }
        .add-button:hover, .back-button:hover, .update-button:hover {
            background-color: #005f7a; /* Darker color on hover */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Edit Vehicle Category</h1>
        <a href="VehicleCategory.php" class="back-button">Back</a>
    </div>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $category_id; ?>">
        <label for="vehicle_category">Vehicle Category:</label>
        <input type="text" id="vehicle_category" name="vehicle_category" value="<?php echo $vehicle_category; ?>" required>
        <button type="submit" class="update-button">Update</button>
    </form>
</body>
</html>

