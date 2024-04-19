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
    $slot_id = $_POST['id'];
    $vehicle_category = $_POST['vehicle_category'];
    $slot_number = $_POST['slot_number'];
    $status = $_POST['status'];

    // Update the slot in the database
    $sql = "UPDATE slots SET 
                vehicle_category = '$vehicle_category',
                slot_number = '$slot_number',
                status = '$status'
            WHERE id = $slot_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the slot management page
        header("Location: ParkingSlot.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve the slot details based on the ID from the database
if (isset($_GET['id'])) {
    $slot_id = $_GET['id'];
    $sql = "SELECT * FROM slots WHERE id = $slot_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vehicle_category = $row['vehicle_category'];
        $slot_number = $row['slot_number'];
        $status = $row['status'];
    } else {
        echo "Slot not found";
        exit();
    }
} else {
    echo "Slot ID not provided";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Slot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2; /* Light background color */
        }

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #28a745; /* Green */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px; /* Rounded corners */
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        a.back-button {
            background-color: #28a745; /* Green */
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            float: left;
        }

        a.back-button:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <h1>Edit Slot</h1>
    <a href="ParkingSlot.php" class="back-button">Back</a>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $slot_id; ?>">
        <label for="vehicle_category">Vehicle Category:</label>
        <input type="text" id="vehicle_category" name="vehicle_category" value="<?php echo $vehicle_category; ?>" required><br><br>
        <label for="slot_number">Slot Number:</label>
        <input type="text" id="slot_number" name="slot_number" value="<?php echo $slot_number; ?>" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Active" <?php if ($status == 'Active') echo 'selected'; ?>>Active</option>
            <option value="Inactive" <?php if ($status == 'Inactive') echo 'selected'; ?>>Inactive</option>
        </select><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
