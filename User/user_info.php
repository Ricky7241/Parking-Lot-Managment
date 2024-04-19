<?php

include '../db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $name = htmlspecialchars($row['name']);
    $email = htmlspecialchars($row['email']);
    $address = htmlspecialchars($row['address']);
}

// Query to count the number of cars parked by the user
$count_cars_sql = "SELECT COUNT(*) AS total_cars FROM cars WHERE user_id = $user_id";
$count_cars_result = $conn->query($count_cars_sql);

if ($count_cars_result->num_rows == 1) {
    $count_row = $count_cars_result->fetch_assoc();
    $no_of_car_parked = htmlspecialchars($count_row['total_cars']);
} else {
    echo "User not found.";
    exit();
}

// Query car information for the user
$car_sql = "SELECT * FROM cars WHERE user_id = $user_id";
$car_result = $conn->query($car_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        p {
            margin: 10px 0;
            color: #666;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>User Information</h1>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <?php if (isset($no_of_car_parked)) : ?>
                <p><strong>No. of Cars Parked:</strong> <?php echo $no_of_car_parked; ?></p>
            <?php endif; ?>
            <div class="button-container">
                <a href="add_car.php"><button>Add Car</button></a>
                <a href="user_logout.php"><button>Logout</button></a> <!-- New logout button -->
            </div>
        </div>
        <div class="card">
            <h2>Car Information</h2>
            <?php if ($car_result->num_rows > 0) : ?>
                <?php while ($car_row = $car_result->fetch_assoc()) : ?>
                    <p><strong>Model:</strong> <?php echo htmlspecialchars($car_row['model']); ?></p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($car_row['vehicle_type']); ?></p>
                    <p><strong>Year:</strong> <?php echo htmlspecialchars($car_row['year']); ?></p>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No cars added yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

