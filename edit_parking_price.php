<?php
include 'db_connect.php';

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = $_GET['id'];

    // Prepare and execute SELECT query to retrieve parking price details
    $sql = "SELECT * FROM parking_prices WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record with the provided ID exists
    if($result->num_rows == 1) {
        // Fetch the parking price details
        $row = $result->fetch_assoc();

        // Display a form pre-filled with existing details
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Parking Price</title>
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
<h2>Edit Parking Price</h2>
<div class="center">
    <a href="parking_prices_management.php" class="back-button">Back</a>
</div>
<form action="parking_prices_management.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="category">Category:</label>
    <input type="text" name="category" value="<?php echo $row['category']; ?>" required><br>

    <label for="duration">Time Duration:</label>
    <input type="text" name="duration" value="<?php echo $row['duration']; ?>" required><br>

    <label for="price">Parking Prices:</label>
    <input type="number" name="price" value="<?php echo $row['price']; ?>" required><br>

    <div class="center">
        <input type="submit" value="Update">
    </div>
</form>
</body>
</html>
<?php
    } 

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
