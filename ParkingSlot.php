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

// Pagination
$limit = isset($_GET['limit']) ? $_GET['limit'] : 3; // Default limit is 3
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Default page is 1
$offset = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Retrieve data from the database with limit, offset, and search
$sql = "SELECT * FROM slots";

// Add search condition if search query is provided
if (!empty($search)) {
    $sql .= " WHERE vehicle_category LIKE '%$search%' OR slot_number LIKE '%$search%' OR status LIKE '%$search%'";
}

$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Parking Slot Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7; /* Light grey background */
            color: #333; /* Dark text color */
        }

        .header {
            background-color: #4CAF50; /* Green header background */
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-between; /* Align items horizontally */
            align-items: center; /* Align items vertically */
        }

        h1 {
            margin: 0;
            font-size: 36px;
            color: #fff; /* White text color */
        }

        .button-container {
            display: flex;
            align-items: center;
        }

        .add-button {
            padding: 10px 20px;
            background-color: #008CBA; /* Blue button background */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove default link underline */
        }

        .add-button:hover {
            background-color: #00688b; /* Darker blue on hover */
        }

        .back-button {
            padding: 10px 20px;
            background-color: #008CBA; /* Blue button background */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove default link underline */
        }

        .back-button:hover {
            background-color: #00688b; /* Darker blue on hover */
        }

        .search-container {
            display: flex;
            justify-content: space-between; /* Align items to the sides */
            margin-top: 20px;
            padding: 20px;
        }

        #entries {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .search-input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .search-button {
            padding: 8px 16px;
            background-color: #008CBA; /* Blue button background */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #00688b; /* Darker blue on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd; /* Light grey border */
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50; /* Green header background */
            color: #fff; /* White text color */
        }

        .action-links a {
            color: #008CBA; /* Blue action links */
            text-decoration: none;
            transition: color 0.3s;
        }

        .action-links a:hover {
            color: #00688b; /* Darker blue on hover */
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-right: 5px;
            color: #fff; /* White text color */
            background-color: #4CAF50; /* Green button background */
        }

        .pagination a.active {
            background-color: #008CBA; /* Blue active page background */
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="admin_dashboard.php" class="back-button">Back</a>
        <h1>Parking Slot Management</h1>
        <div class="button-container">
            <a href="add_slot.php" class="add-button">Add Slot</a>
        </div>
    </div>
    <div class="search-container">
        <div>
            <label for="entries">Number of Entries:</label>
            <select id="entries" onchange="location = 'ParkingSlot.php?limit=' + this.value + '&page=1'">
                <option value="3" <?php if ($limit == 3) echo 'selected'; ?>>3</option>
                <option value="5" <?php if ($limit == 5) echo 'selected'; ?>>5</option>
                <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
            </select>
        </div>
        <div>
            <form method="get" action="ParkingSlot.php">
                <input type="text" id="search" name="search" class="search-input" value="<?php echo $search; ?>">
                <button class="search-button" type="submit">Search</button>
                <?php if (!empty($search)): ?>
                    <a href="ParkingSlot.php"><button type="button">Clear</button></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehicle Category</th>
                <th>Slot Number</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["vehicle_category"] . "</td>
                            <td>" . $row["slot_number"] . "</td>
                            <td>" . $row["status"] . "</td>
                            <td>" . $row["created_at"] . "</td>
                            <td>" . $row["updated_at"] . "</td>
                            <td class='action-links'><a href='edit_slot.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_slot.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>0 results</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        // Pagination links
        $sql = "SELECT COUNT(*) AS total FROM slots";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_records = $row['total'];
        $total_pages = ceil($total_records / $limit);

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='ParkingSlot.php?page=" . $i . "&limit=" . $limit . "'";
            if ($i == $page) {
                echo " class='active'";
            }
            echo ">" . $i . "</a>";
        }
        ?>
    </div>
</body>
</html>


