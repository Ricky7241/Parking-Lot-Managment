<?php
include '../db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve car information from the form
    $model = $_POST["model"];
    $type = $_POST["type"];
    $year = $_POST["year"];

    // Insert the car information into the database
    $insert_sql = "INSERT INTO cars (user_id, model, vehicle_type, year) VALUES ($user_id, '$model', '$type', '$year')";
    if ($conn->query($insert_sql) === TRUE) {
        // Redirect to user dashboard after adding the car
        header("Location: user_info.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <a href="user_info.php" class="back-button">Back</a>
    <h1>Add Car</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="model">Model:</label>
        <input type="text" name="model" id="model" required><br><br>
        <label for="type">Type:</label>
        <input type="text" name="type" id="type" required><br><br>
        <label for="year">Year:</label>
        <input type="text" name="year" id="year" required><br><br>
        <button type="submit">Add Car</button>
    </form>
</body>
</html>
