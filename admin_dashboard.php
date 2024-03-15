<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--Include Chart.js library -->
</head>
<body>
   <header>
           <h1>Admin Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="#">Vehicle Category</a></li>
                    <li><a href="#">Parking Duration</a></li>
                    <li><a href="#">Parking Rate</a></li>
                    <li><a href="#">Parking Slots</a></li>
                    <li><a href="#">Customers</a></li>
                    <li><a href="#">Users</a></li>
                    <li><a href="#">Logout</a></li>
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
    </div>
   
    <script>
        const dailyCtx = document.getElementById('dailyRevenueChart').getContext('2d');
        const monthlyCtx = document.getElementById('monthlyRevenueChart').getContext('2d');

        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
                datasets: [{
                    label: 'Daily Revenue',
                    data: [
                        200, 250, 300, 200, 350, 400, 250, 300, 350, 400, 200, 250, 300, 350, 400, 250, 300, 350, 400, 200, 250, 300, 350, 400, 250, 300, 350, 400, 200, 250, 300
                    ],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
              }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Revenue',
                    data: [
                        20000, 15000, 10000, 12000, 18000, 21000, 19000, 22000, 25000, 23000, 27000, 30000
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding-top: 50px;
        }

        .sidebar {
            width: 20%;
            padding: 20px;
        }

        .main-content {
            margin-top: 70px; /* Adjust this value according to the height of your header */
            width: 78%;
        }

        .revenue-container {
            display: flex;
            justify-content: space-between;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .chart {
            width: 48%;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }


            .revenue-container {
                flex-direction: column;
            }

            .chart-container {
                flex-direction: column;
            }

            .chart {
                width: 100%;
            }
        }

        header {
            background-color: rgb(229, 229, 229);
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 10px 0;
            /* Remove fixed positioning from header */
            /* position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%; */
            font-weight: bold;
        }

        header ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 50px;
        }

        header li {
            padding: 0 10px;
        }

        header a {
            text-decoration: none;
            color: #333;
        }

        header a:hover {
            color: #007bff;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</body>
</html>
