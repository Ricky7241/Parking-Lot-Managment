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
$sql = "SELECT id, vehicle_category, created_at, updated_at FROM categories";

// Add search condition if search query is provided
if (!empty($search)) {
    $sql .= " WHERE vehicle_category LIKE '%$search%'";
}

$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Category Management</title>
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
    color: #fff;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
}

.edit-button {
    background-color: #007bff; /* Blue edit button */
}

.delete-button {
    background-color: #dc3545; /* Red delete button */
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
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px; /* Rounded corners */
}

.add-button:hover, .search-button:hover {
    background-color: #005f7a; /* Darker color on hover */
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

.search-div {
    background-color: #E0FFFF; /* Light blue background for search div */
    padding: 10px;
    border-radius: 6px; /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
}

.pagination-div {
    background-color: #FFFACD; /* Light yellow background for pagination div */
    padding: 10px;
    border-radius: 6px; /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
}

    </style>
</head>
<body>
    <div class="header">
        <a href="admin_dashboard.php">Back</a>
        <h1>Vehicle Category Management</h1>
        <a href="add_category.php"><button class="add-button">Category ADD</button></a>
    </div>
    <div class="search">
        <div>
            <label for="entries">Number of Entries:</label>
            <select id="entries" onchange="location = 'VehicleCategory.php?limit=' + this.value + '&page=1'">
                <option value="3" <?php if ($limit == 3) echo 'selected'; ?>>3</option>
                <option value="5" <?php if ($limit == 5) echo 'selected'; ?>>5</option>
                <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
            </select>
        </div>
        <div>
            <form method="get" action="VehicleCategory.php">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" value="<?php echo $search; ?>">
                <button class="search-button" type="submit">Search</button>
                <?php if (!empty($search)): ?>
                    <a href="VehicleCategory.php"><button type="button">Clear</button></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehicle Category</th>
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
                            <td>" . $row["created_at"] . "</td>
                            <td>" . $row["updated_at"] . "</td>
                            <td>
                                <a href='edit_category.php?id=" . $row["id"] . "'>Edit</a> | 
                                <a href='delete_category.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>

                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div>
        <?php
        // Pagination links
        $sql = "SELECT COUNT(id) AS total FROM categories";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $limit);

        if ($total_pages > 1) {
            echo "<br><br>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='VehicleCategory.php?page=$i&limit=$limit'>$i</a> ";
            }
        }
        ?>
    </div>
</body>
</html>



