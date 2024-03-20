<!-- <!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-button {
            float: right;
        }
        .search-button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    //<?php
    //$servername = "localhost";
    //$username = "root";
    //$password = "";
    //$dbname = "user_authentication";

    // Create connection
    //$conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    //if ($conn->connect_error) {
        //die("Connection failed: " . $conn->connect_error);
    //}
     // Pagination
     //$limit = isset($_GET['limit']) ? $_GET['limit'] : 3;
     //$page = isset($_GET['page']) ? $_GET['page'] : 1;
     //$offset = ($page - 1) * $limit;

 
     // Retrieve data from the database with limit and offset
     //$sql = "SELECT id, vehicle_category, created_at, updated_at FROM categories LIMIT $limit OFFSET $offset";
     //$result = $conn->query($sql);
    //?>
    <div class="header">
        <a href="admin_dashboard.php">Back</a>
        <h1>Vehicle Category Management</h1>
        <button class="add-button">Category ADD</button>
    </div>
    <div class="search">
        <div>
        echo "<label for='entries'>Number of Entries:</label><br>";
echo "<select id='entries' onchange=\"location = 'category_management.php?limit=' + this.value + '&page=1'\">";
echo "<option value='3' " . ($limit == 3 ? "selected" : "") . ">3</option>";
echo "<option value='5' " . ($limit == 5 ? "selected" : "") . ">5</option>";
echo "<option value='10' " . ($limit == 10 ? "selected" : "") . ">10</option>";
echo "<option value='20' " . ($limit == 20 ? "selected" : "") . ">20</option>";
echo "</select><br>";


</select>
        </div>
        <div>
            <label for="search">Search:</label>
            <input type="text" id="search">
            <button class="search-button">Search</button>
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
            //<?php
            // Retrieve data from the database
            //$sql = "SELECT id, vehicle_category, created_at, updated_at FROM categories";
            //$result = $conn->query($sql);

            //if ($result->num_rows > 0) {
                //while ($row = $result->fetch_assoc()) {
                    //echo "<tr>
                            //<td>" . $row["id"] . "</td>
                            //<td>" . $row["vehicle_category"] . "</td>
                            //<td>" . $row["created_at"] . "</td>
                            //<td>" . $row["updated_at"] . "</td>
                            //<td>Edit | Delete</td>
                        //</tr>";
                //}
            //} else {
                //echo "<tr><td colspan='5'>0 results</td></tr>";
            //}

           // $conn->close();
           //?>
        </tbody>
    </table>
</body>
</html> -->
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

// Retrieve data from the database with limit and offset
$sql = "SELECT id, vehicle_category, created_at, updated_at FROM categories LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-button {
            float: right;
        }
        .search-button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="admin_dashboard.php">Back</a>
        <h1>Vehicle Category Management</h1>
        <button class="add-button">Category ADD</button>
    </div>
    <div class="search">
        <div>
            <label for="entries">Number of Entries:</label>
            <select id="entries" onchange="location = 'category_management.php?limit=' + this.value + '&page=1'">
                <option value="3" <?php if ($limit == 3) echo 'selected'; ?>>3</option>
                <option value="5" <?php if ($limit == 5) echo 'selected'; ?>>5</option>
                <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
            </select>
        </div>
        <div>
            <label for="search">Search:</label>
            <input type="text" id="search">
            <button class="search-button">Search</button>
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
                            <td>Edit | Delete</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            $conn->close();
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
                echo "<a href='category_management.php?page=$i&limit=$limit'>$i</a> ";
            }
        }
        ?>
    </div>
</body>
</html>
