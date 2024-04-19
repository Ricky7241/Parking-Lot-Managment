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
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $in_time = $_POST['in_time'];
    $out_time = $_POST['out_time'];
    $vehicle_category = $_POST['vehicle_category'];
    $entered_by = $_POST['entered_by'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    // Insert the new customer into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO customers (customer_name, customer_contact, in_time, out_time, vehicle_category, entered_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $customer_name, $customer_contact, $in_time, $out_time, $vehicle_category, $entered_by, $created_at, $updated_at);
    
    if ($stmt->execute()) {
        // Redirect back to the customer management page
        header("Location: customer_management.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
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
            width: 400px;
            margin: 0 auto; /* Center the form horizontally */
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333; /* Dark text color */
        }

        input[type="text"],
        input[type="datetime-local"],
        button {
            padding: 8px 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc; /* Light grey border */
            border-radius: 3px;
            width: 100%;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
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
            margin-right: 10px;
        }

        .back-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <a href="customer_management.php" class="back-button">Back</a>
    <h1>Add Customer</h1>
    <form id="addCustomerForm" method="post" action="add_customer.php">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>
        <label for="customer_contact">Contact Number:</label>
        <input type="text" id="customer_contact" name="customer_contact" required><br>
        <label for="in_time">In Time:</label>
        <input type="datetime-local" id="in_time" name="in_time" required><br>
        <label for="out_time">Out Time:</label>
        <input type="datetime-local" id="out_time" name="out_time" required><br>
        <label for="vehicle_category">Vehicle Category:</label>
        <input type="text" id="vehicle_category" name="vehicle_category" required><br>
        <label for="entered_by">Entered By:</label>
        <input type="text" id="entered_by" name="entered_by" required><br>
        <button type="submit">Add Customer</button>
    </form>

    <script>
        // Redirect to customer_management.php when the form is submitted
        document.getElementById('addCustomerForm').addEventListener('submit', function() {
            window.location.href = 'customer_management.php';
        });
    </script>
</body>
</html>
