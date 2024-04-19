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
    $vehicle_category = $_POST['vehicle_category'];
    $slot_number = $_POST['slot_number'];
    $status = $_POST['status'];

    // Insert the new category into the database
    $sql = "INSERT INTO slots (vehicle_category, slot_number, status) VALUES ('$vehicle_category', '$slot_number', '$status')";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the category management page
        header("Location: ParkingSlot.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if a category is being deleted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the category from the database
    $delete_sql = "DELETE FROM slots WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        // Reset the auto-increment value to the next available ID
        $reset_sql = "ALTER TABLE slots AUTO_INCREMENT = (SELECT MAX(id) + 1 FROM slots)";
        if ($conn->query($reset_sql) === FALSE) {
            echo "Error resetting auto-increment: " . $conn->error;
        }

        // Redirect back to the category management page
        header("Location: ParkingSlot.php");
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
    <title>Add Parking Slot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center; /* Center align the header */
            margin-bottom: 20px;
        }
        h1 {
            font-size: 36px; /* Larger heading size */
            margin: 0; /* Remove margin */
        }
        label {
            font-size: 24px; /* Larger label size */
            font-weight: bold; /* Bold label */
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 300px; /* Set width for text fields */
            padding: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .add-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .add-button:hover {
            background-color: #45a049;
        }
        .back-button {
            text-decoration: none;
            font-size: 18px;
            color: #333;
            float: left; /* Float the back button to the left */
            margin-bottom: 20px; /* Add margin to separate from the heading */
            padding: 10px 20px; /* Add padding to the button */
            border-radius: 4px; /* Add border-radius to create rounded corners */
            background-color: #28a745; /* Set the background color to green */
            color: white; /* Set text color to white */
        }
        .back-button:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Add Parking Slot</h1>
        <a href="ParkingSlot.php" class="back-button">Back</a><br><br><br>
    </div>
    <form method="post" action="add_slot.php">
        <label for="vehicle_category">Vehicle Category:</label>
        <input type="text" id="vehicle_category" name="vehicle_category"><br>
        <label for="slot_number">Slot Number:</label>
        <input type="text" id="slot_number" name="slot_number"><br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status"><br>
        <input type="submit" value="Add" class="add-button">
    </form>
</body>
</html>


















<?php
/*include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted with POST method
    $vehicle_category = $_POST['vehicle_category'];
    $slot_number = $_POST['slot_number'];
    $status = $_POST['status'];
    // Prepare and execute INSERT query
    $sql = "INSERT INTO slots (vehicle_category, slot_number, status) VALUES ('$vehicle_category', '$slot_number', '$status')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $vehicle_category, $slot_number, $status);
    
    if ($stmt->execute()) {
        // Redirect back to the parking prices management page
        header("Location: ParkingSlot.php");
        exit();
    } else {
        echo "Error: Failed to add parking price.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

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
    $vehicle_category = $_POST['vehicle_category'];
    $slot_number = $_POST['slot_number'];
    $status = $_POST['status'];

    // Insert the new category into the database
    $sql = "INSERT INTO slots (vehicle_category, slot_number, status) VALUES ('$vehicle_category', '$slot_number', '$status')";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the category management page
        header("Location: ParkingSlot.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if a category is being deleted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the category from the database
    $delete_sql = "DELETE FROM slots WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        // Reset the auto-increment value to the next available ID
        $reset_sql = "ALTER TABLE slots AUTO_INCREMENT = (SELECT MAX(id) + 1 FROM slots)";
        if ($conn->query($reset_sql) === FALSE) {
            echo "Error resetting auto-increment: " . $conn->error;
        }

        // Redirect back to the category management page
        header("Location: ParkingSlot.php");
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
    <title>Add Parking Slot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center; // Center align the header 
            margin-bottom: 20px;
        }
        h1 {
            font-size: 36px; /* Larger heading size 
            margin: 0; Remove margin 
        }
        label {
            font-size: 24px; /* Larger label size 
            font-weight: bold; /* Bold label 
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 300px; /* Set width for text fields 
            padding: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .add-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .add-button:hover {
            background-color: #45a049;
        }
        .back-button {
            text-decoration: none;
            font-size: 18px;
            color: #333;
            float: left; /* Float the back button to the left 
            margin-bottom: 20px; /* Add margin to separate from the heading 
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Add Parking Slot</h1>
        <a href="ParkingSlot.php" class="back-button">Back</a><br><br>
    </div>
    <form method="post" action="ParkingSlot.php">
        <label for="vehicle_category">Vehicle Category:</label>
        <input type="text" id="vehicle_category" name="vehicle_category"><br>
        <label for="slot_number">Slot Number:</label>
        <input type="text" id="slot_number" name="slot_number"><br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status"><br>
        <input type="submit" value="Add" class="add-button">
    </form>
</body>
</html>







<?php
/*include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted with POST method
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Prepare and execute INSERT query
    $sql = "INSERT INTO parking_prices (category, duration, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $category, $duration, $price);
    
    if ($stmt->execute()) {
        // Redirect back to the parking prices management page
        header("Location: parking_prices_management.php");
        exit();
    } else {
        echo "Error: Failed to add parking price.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Parking Prices</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    h2 {
      text-align: center;
    }
    table {
      margin: 0 auto; // Center the table 
      width: 80%; // Adjust the width as needed 
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .action-buttons a {
      color: #fff;
      padding: 5px 10px;
      border-radius: 4px;
      text-decoration: none;
      margin-right: 5px;
    }
    .edit-button {
      background-color: #007bff; // Blue 
    }
    .delete-button {
      background-color: #dc3545; // Red 
    }
    .add-button {
      background-color: #28a745; // Green 
      color: #fff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
      float: right;
      margin-bottom: 10px;
    }
    .search-bar {
      float: right;
      margin-bottom: 10px;
      margin-right: 10px;
    }
    .center {
      text-align: center;
    }
  </style>
  <h2>Add Parking Prices</h2>
  <div class="center">
    <a href="parking_prices_management.php">Parking Prices Management</a>
  </div>
</head>
<body>
  
  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <div class="center">
    <label for="category">Category:</label>
    <input type="text" name="category" required><br>

    <label for="duration">Time Duration:</label>
    <input type="text" name="duration" required><br>

    <label for="price">Parking Prices:</label>
    <input type="number" name="price"  required><br>

    <input type="submit" value="Add">
    </div>
  </form>
</body>
</html>*/