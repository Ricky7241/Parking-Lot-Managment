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
    $customer_id = $_POST['id'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $in_time = $_POST['in_time'];
    $out_time = $_POST['out_time'];
    $vehicle_category = $_POST['vehicle_category'];
    $entered_by = $_POST['entered_by'];

    // Update the customer in the database
    $sql = "UPDATE customers SET 
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                in_time = '$in_time',
                out_time = '$out_time',
                vehicle_category = '$vehicle_category',
                entered_by = '$entered_by'
            WHERE id = $customer_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the customer management page
        header("Location: customer_management.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve the customer details based on the ID from the database
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $sql = "SELECT * FROM customers WHERE id = $customer_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_name = $row['customer_name'];
        $customer_contact = $row['customer_contact'];
        $in_time = $row['in_time'];
        $out_time = $row['out_time'];
        $vehicle_category = $row['vehicle_category'];
        $entered_by = $row['entered_by'];
    } else {
        echo "Customer not found";
        exit();
    }
} else {
    echo "Customer ID not provided";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7; /* Light grey background */
        }

        h1 {
            color: #333; /* Dark text color */
        }

        form {
            margin-top: 20px;
            background-color: #fff; /* White background */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
        }

        input[type="text"],
        input[type="datetime-local"],
        button {
            padding: 8px 12px;
            margin-bottom: 10px;
            border: none;
            border-radius: 3px;
        }

        button {
            background-color: #4CAF50; /* Green button background */
            color: #fff; /* White text color */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .back-button {
            background-color: #4CAF50; /* Green button background */
            color: #fff; /* White text color */
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <a href="customer_management.php" class="back-button">Back</a>
    <h1>Edit Customer</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required><br>
        <label for="customer_contact">Customer Contact:</label>
        <input type="text" id="customer_contact" name="customer_contact" value="<?php echo $customer_contact; ?>" required><br>
        <label for="in_time">In Time:</label>
        <input type="datetime-local" id="in_time" name="in_time" value="<?php echo date('Y-m-d\TH:i', strtotime($in_time)); ?>" required><br>
        <label for="out_time">Out Time:</label>
        <input type="datetime-local" id="out_time" name="out_time" value="<?php echo date('Y-m-d\TH:i', strtotime($out_time)); ?>" required><br>
        <label for="vehicle_category">Vehicle Category:</label>
        <input type="text" id="vehicle_category" name="vehicle_category" value="<?php echo $vehicle_category; ?>" required><br>
        <label for="entered_by">Entered By:</label>
        <input type="text" id="entered_by" name="entered_by" value="<?php echo $entered_by; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
