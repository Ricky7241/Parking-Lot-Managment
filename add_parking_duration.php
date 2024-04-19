<?php
// Include the database connection file
include 'db_connect.php';

// Check if form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $duration = $_POST['duration'];

    // Prepare and execute INSERT query
    $sql = "INSERT INTO parking_duration (duration) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $duration);
    $stmt->execute();

    // Check if insertion was successful
    if($stmt->affected_rows > 0) {
        // Redirect back to the parking duration management page
        header("Location: parking_duration.php");
        exit();
    } else {
        echo "Error: Failed to add parking duration.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Parking Duration</title>
    <style>
        /* Center the container div */
        .container {
            text-align: center;
        }
        /* Style for the form elements */
        form {
            margin-top: 20px; /* Add some space between the link and the form */
        }
        label {
            display: block; /* Display labels on separate lines */
            margin-bottom: 5px; /* Add space below labels */
        }
        input[type="text"] {
            width: 200px; /* Set the width of the text input */
            padding: 5px; /* Add some padding */
            margin-bottom: 10px; /* Add space below the text input */
        }
        input[type="submit"] {
            padding: 8px 20px; /* Add padding to the submit button */
            background-color: green; /* Change the background color */
            color: white; /* Set text color to white */
            border: none; /* Remove border */
            cursor: pointer; /* Add pointer cursor on hover */
        }
        /* Style for the Back button */
.back-button {
    background-color: green; /* Blue color for the button */
    color: white; /* White text color */
    padding: 8px 16px; /* Padding around the text */
    border-radius: 4px; /* Rounded corners */
    text-decoration: none; /* Remove underline */
    margin: 20px; /* Add margin around the button */
    position: absolute; /* Position the button */
    top: 20px; /* Distance from the top of the page */
    left: 20px; /* Distance from the left of the page */
}

.back-button:hover {
    background-color: #0056b3; /* Darker blue color on hover */
}

    </style>
</head>
<body>
    <h1 style="text-align: center;">Add Parking Duration</h1>
    <div class="container"> <!-- Centered container div -->
        <div style="text-align: left; margin-left: 20px;">
        <a href="parking_duration.php" class="back-button">Back</a>


        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="text-align: center;">
            <label for="duration" style="display: block; margin-bottom: 10px;">Duration:</label>
            <input type="text" id="duration" name="duration" required style="width: 200px; padding: 5px; margin-bottom: 10px;"><br>
            <input type="submit" value="Add" style="padding: 8px 20px; background-color: green; color: white; border: none; cursor: pointer;">
        </form>
    </div>
</body>
</html>
