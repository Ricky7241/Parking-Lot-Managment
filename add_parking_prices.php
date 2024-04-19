<?php
include 'db_connect.php';

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
            margin: 20px;
            background-color: #f2f2f2; /* Light background color */
        }

        h2 {
            text-align: center;
        }

        .center {
            text-align: center;
            margin-bottom: 20px;
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
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
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
<h2>Add Parking Prices</h2>
<div class="center">
    <a href="parking_prices_management.php" class="back-button">Back</a>
</div>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="category">Category:</label>
    <input type="text" name="category" required><br>

    <label for="duration">Time Duration:</label>
    <input type="text" name="duration" required><br>

    <label for="price">Parking Prices:</label>
    <input type="number" name="price" required><br>

    <div class="center">
        <input type="submit" value="Add">
    </div>
</form>
</body>
</html>
