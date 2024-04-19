<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="VehicleCategory.php">Vehicle Category</a></li>
                <li><a href="parking_duration.php">Parking Duration</a></li>
                <li><a href="parking_prices_management.php">Parking Rate</a></li>
                <li><a href="ParkingSlot.php">Parking Slots</a></li>
                <li><a href="customer_management.php">Customers</a></li>
                <li><a href="user_managment.php">Users</a></li>
                <li><a href="Settings.php">Settings</a></li>
                <li><a href="Profile.php">Profile</a></li> 
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-content">
        <div class="revenue-container">
            <div class="chart-container">
                <div class="chart">
                    <canvas id="dailyRevenueChart"></canvas>
                </div>
                <div class="chart">
                    <canvas id="monthlyRevenueChart"></canvas>
                </div>
            </div>
        </div>
        <div class="month-dropdown">
            <label for="month">Select Month:</label>
            <select id="month" name="month">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
        </div>
        <div class="contact-info">
            <h2>Contact Information</h2>
            <p>Email: admin@example.com</p>
            <p>Phone: +1 (123) 456-7890</p>
        </div>
    </div>
    <script src="admin/scripts.js"></script> 
</html>
