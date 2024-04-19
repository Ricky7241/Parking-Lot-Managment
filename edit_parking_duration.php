<!-- <?php
// include 'db_connect.php';

// // Check if ID parameter is provided
// if(isset($_GET['id'])) {
//     // Sanitize the ID parameter to prevent SQL injection
//     $id = $_GET['id'];

//     // Prepare and execute SELECT query to retrieve parking price details
//     $sql = "SELECT * FROM parking_duration WHERE id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if a record with the provided ID exists
//     if($result->num_rows == 1) {
//         // Fetch the parking price details
//         $row = $result->fetch_assoc();
    
        // Display a form pre-filled with existing details
        // You should implement the form here
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Parking Duration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 0 auto;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"], .back-link {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .back-link {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Edit Parking Duration</h2>
    <div class="container"> <!-- Centered container div -->
        <!-- <div style="text-align: left; margin-left: 20px;">
            <a href="parking_duration.php" class="back-link">Back</a>
        </div>
        <form action="update_parking_duration.php" method="POST">
            <?php
            // include 'db_connect.php';

            // // Check if ID parameter is provided
            // if (isset($_GET['id'])) {
            //     // Sanitize the ID parameter to prevent SQL injection
            //     $id = $_GET['id'];

            //     // Prepare and execute SELECT query to retrieve parking duration details
            //     $sql = "SELECT * FROM parking_duration WHERE id = ?";
            //     $stmt = $conn->prepare($sql);
            //     $stmt->bind_param("i", $id);
            //     $stmt->execute();
            //     $result = $stmt->get_result();

            //     // Check if a record with the provided ID exists
            //     if ($result->num_rows == 1) {
            //         // Fetch the parking duration details
            //         $row = $result->fetch_assoc();

            //         // Display a form pre-filled with existing details
            //         echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            //         echo '<label for="duration">Duration:</label><br>';
            //         echo '<input type="text" id="duration" name="duration" value="' . $row['duration'] . '"><br>';
            //         echo '<input type="submit" value="Update">';
            //     } else {
            //         echo "Error: Parking duration not found.";
            //     }

            //     // Close statement
            //     $stmt->close();
            // }
        
            // // Close connection
            // $conn->close();
            ?>
        </form>
    </div>
</body>
</html>  -->
        

<?php
include 'db_connect.php';

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = $_GET['id'];

    // Prepare and execute SELECT query to retrieve parking price details
    $sql = "SELECT * FROM parking_duration WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record with the provided ID exists
    if($result->num_rows == 1) {
        // Fetch the parking price details
        $row = $result->fetch_assoc();
    
        // Display a form pre-filled with existing details
        // You should implement the form here
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Parking Duration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 0 auto;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"], .back-link {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .back-link {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Edit Parking Duration</h2>
    <div class="container"> <!-- Centered container div -->
        <div style="text-align: left; margin-left: 20px;">
            <a href="parking_duration.php" class="back-link">Back</a>
        </div>
        <form action="update_parking_duration.php" method="POST">
            <?php
            if(isset($row)) {
                // Display the form with pre-filled data
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<label for="duration">Duration:</label><br>';
                echo '<input type="text" id="duration" name="duration" value="' . $row['duration'] . '"><br>';
                echo '<input type="submit" value="Update">';
            } else {
                echo "Error: Parking duration not found.";
            }
            ?>
        </form>
    </div>
</body>
</html>
