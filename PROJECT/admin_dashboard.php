<?php
// Include the header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--<link rel="stylesheet" href="styles.css">  Include your CSS file -->
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="VehicleCategory.php">Vehicle Category</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Settings.php">Setting</a></li>
                <li><a href="#">Parking Duration</a></li>
                <li><a href="#">Parking Rate</a></li>
                <li><a href="#">Parking Slots</a></li>
                <li><a href="#">Customers</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="sidebar">
            <h2>Revenue</h2>
            <form action="" method="post">
                <select name="month">
                    <option value="1">January</option>
                    <!-- Add options for other months -->
                </select>
                <input type="submit" value="Go">
            </form>
            <div class="chart">
                <!-- Display revenue chart here using JavaScript -->
            </div>
        </div>
        <div class="main-content">
            <!-- You can add content here -->
        </div>
    </div>
    <footer>
        <p>Contact information</p>
    </footer>
    <script src="Chart.min.js"></script> <!-- Include Chart.js library -->
    <script src="scripts.js"></script> <!-- Include your JavaScript file for chart rendering -->
</body>
</html>