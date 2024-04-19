<?php
include '../db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch car information for the user
$car_sql = "SELECT * FROM cars WHERE user_id = $user_id";
$car_result = $conn->query($car_sql);

if ($car_result->num_rows == 1) {
    $car_row = $car_result->fetch_assoc();
    $model = htmlspecialchars($car_row['model']);
    $type = htmlspecialchars($car_row['vehicle_type']);
    $year = htmlspecialchars($car_row['year']);
} else {
    echo "Car not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve car information from the form
    $model = $_POST["model"];
    $type = $_POST["type"];
    $year = $_POST["year"];

    // Update the car information in the database
    $update_sql = "UPDATE cars SET model='$model', vehicle_type='$type', year='$year' WHERE user_id=$user_id";
    if ($conn->query($update_sql) === TRUE) {
        // Redirect to user dashboard after updating the car
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
    <title>Edit Car</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <h1>Edit Car</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="model">Model:</label>
        <input type="text" name="model" id="model" value="<?php echo $model; ?>" required><br><br>
        <label for="type">Type:</label>
        <input type="text" name="type" id="type" value="<?php echo $type; ?>" required><br><br>
        <label for="year">Year:</label>
        <input type="text" name="year" id="year" value="<?php echo $year; ?>" required><br><br>
        <button type="submit">Update Car</button>
    </form>
</body>
</html>
