<?php
include 'db_connect.php';

$limit = isset($_GET['limit']) ? $_GET['limit'] : 3; // Default limit is 3
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Default page is 1
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM parking_prices";
if (!empty($search)) {
    $sql .= " WHERE category LIKE '%$search%'";
}

// Get total number of records for pagination
$total_pages_sql = "SELECT COUNT(*) AS total FROM parking_prices";
$result_total_pages = $conn->query($total_pages_sql);
$total_rows = $result_total_pages->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parking Prices Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2; /* Light background color */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: #4CAF50; /* Green header background */
            padding: 10px;
            color: white;
            border-radius: 6px; /* Rounded corners */
        }

        .search {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 12px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .action-buttons a {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }

        .edit-button, .delete-button {
            border: none;
            background: none;
            color: #007bff; /* Blue color for edit button */
            cursor: pointer;
        }

        .edit-button:hover, .delete-button:hover {
            text-decoration: underline;
        }

        .add-button, .search-button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px; /* Rounded corners */
        }

        .add-button:hover, .search-button:hover {
            background-color: #005f7a; /* Darker color on hover */
        }

        .search-bar {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .search-bar:focus {
            outline: none;
            border-color: #007bff; /* Blue border on focus */
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin-right: 4px;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #ddd;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<div class="header">
    <a href="admin_dashboard.php">Back</a>
    <h1>Parking Prices Management</h1>
    <a href="add_parking_prices.php"><button class="add-button">Add</button></a>
</div>
<div class="search">
    <form method="get" action="parking_prices_management.php" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div style="display: flex; align-items: center;">
            <label for="entries" style="margin-right: 10px;">Number of Entries:</label>
            <select id="entries" name="limit" onchange="this.form.submit()">
                <option value="3" <?php if ($limit == 3) echo 'selected'; ?>>3</option>
                <option value="5" <?php if ($limit == 5) echo 'selected'; ?>>5</option>
                <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
            </select>
        </div>
        <div>
            <label for="search">Search by Category:</label>
            <input type="text" id="search" name="search" value="<?php echo $search; ?>">
            <button class="search-button" type="submit">Search</button>
            <?php if (!empty($search)): ?>
                <a href="parking_prices_management.php"><button type="button">Clear</button></a>
            <?php endif; ?>
        </div>
    </form>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Duration</th>
        <th>Price</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result !== null && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["duration"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "<td>" . $row["updated_at"] . "</td>";
            echo "<td class='action-buttons'><a href='edit_parking_price.php?id=" . $row["id"] . "' class='edit-button'>Edit</a> <a href='delete_parking_price.php?id=" . $row["id"] . "' class='delete-button'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
    ?>
    </tbody>
</table>
<div class="pagination">
    <?php
    if ($total_pages > 1) {
        $range = 2; // Number of pages to show before and after the current page
        $start = $page - $range;
        $end = $page + $range;
        if ($start < 1) {
            $start = 1;
            $end = min($total_pages, $start + $range * 2);
        } elseif ($end > $total_pages) {
            $end = $total_pages;
            $start = max(1, $end - $range * 2);
        }

        if ($page > 1) {
            echo "<a href='parking_prices_management.php?page=1&limit=$limit'>First</a>";
            echo "<a href='parking_prices_management.php?page=".($page - 1)."&limit=$limit'>&laquo;</a>";
        }

        for ($i = $start; $i <= $end; $i++) {
            echo "<a href='parking_prices_management.php?page=$i&limit=$limit'";
            if ($page == $i) echo " class='active'";
            echo ">$i</a>";
        }

        if ($page < $total_pages) {
            echo "<a href='parking_prices_management.php?page=".($page + 1)."&limit=$limit'>&raquo;</a>";
            echo "<a href='parking_prices_management.php?page=$total_pages&limit=$limit'>Last</a>";
        }
    }
    ?>
</div>
</body>
</html>
