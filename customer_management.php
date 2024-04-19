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
$sql = "SELECT id, customer_name, customer_contact, in_time, out_time, vehicle_category, entered_by FROM customers";

// Add search condition if search query is provided
if (!empty($search)) {
    $sql .= " WHERE customer_name LIKE '%$search%'";
}

$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #4CAF50;
            margin: 0;
            font-size: 36px;
        }

        .add-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #45a049;
        }

        .search {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        #entries {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #007AA3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .action-links a {
            color: #008CBA;
            text-decoration: none;
            transition: color 0.3s;
        }

        .action-links a:hover {
            color: #005A7E;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #008CBA;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #008CBA;
            border-radius: 5px;
            margin: 0 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #008CBA;
            color: white;
        }

    </style>
</head>
<body>
<header>
    <a href="admin_dashboard.php">Back</a>
    <h1>Customer Management</h1>
    <a href="add_customer.php"><button class="add-button">Customer Add</button></a>
</header>
<div class="search">
    <div>
        <label for="entries">Number of Entries:</label>
        <select id="entries" onchange="location = 'customer_management.php?limit=' + this.value + '&page=1'">
            <option value="3" <?php if ($limit == 3) echo 'selected'; ?>>3</option>
            <option value="5" <?php if ($limit == 5) echo 'selected'; ?>>5</option>
            <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
            <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
        </select>
    </div>
    <div>
        <form method="get" action="customer_management.php">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" value="<?php echo $search; ?>">
            <button class="search-button" type="submit">Search</button>
            <?php if (!empty($search)): ?>
                <a href="customer_management.php"><button type="button">Clear</button></a>
            <?php endif; ?>
        </form>
    </div>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Customer Name</th>
        <th>Customer Contact</th>
        <th>IN Time</th>
        <th>OUT Time</th>
        <th>Vehicle Category</th>
        <th>Entered By</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["customer_name"] . "</td>
                            <td>" . $row["customer_contact"] . "</td>
                            <td>" . $row["in_time"] . "</td>
                            <td>" . $row["out_time"] . "</td>
                            <td>" . $row["vehicle_category"] . "</td>
                            <td>" . $row["entered_by"] . "</td>
                            <td>
                                <a href='edit_customer.php?id=" . $row["id"] . "'>Edit</a> | 
                                <a href='delete_customer.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>0 results</td></tr>";
    }
    ?>
    </tbody>
</table>
<div>
    <?php
    // Pagination links
    $sql = "SELECT COUNT(id) AS total FROM customers";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $limit);

    if ($total_pages > 1) {
        echo "<br><br>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='customer_management.php?page=$i&limit=$limit'>$i</a> ";
        }
    }
    ?>
</div>
</body>
</html>
