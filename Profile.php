<?php
include 'db_connect.php';

$sql = "SELECT * FROM profile WHERE id = 1"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"]; 
    $password = $row["password"];
} else {
    echo "Admin not found";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']); 
    $password = htmlspecialchars($_POST['password']);

    $sql = "UPDATE profile SET username='$username', password='$password' WHERE id=1"; 
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Profile Updated</h1>";
        echo "<p>Username: $username</p>";
        echo "<p>Password: ****</p>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #28a745; /* Green color */
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838; /* Darker green color on hover */
        }
        .back-link {
            text-align: left; /* Align the back link to the left */
            margin-top: 20px;
        }
        .back-link a {
            color: #28a745; /* Green color */
            text-decoration: none;
            display: block; /* Make the link a block element */
            padding: 5px 10px; /* Add padding to the link */
            border: 1px solid #28a745; /* Add border to the link */
            border-radius: 3px; /* Add border radius to the link */
            width: fit-content; /* Set width to fit the content */
            margin-bottom: 10px; /* Add margin to the bottom of the link */
        }
        .back-link a:hover {
            background-color: #f8f9fa; /* Light grey background on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile</h1>
        <div>
            <h2>Edit Profile</h2>
            <form action="profile.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
                <button type="submit">Save</button>
            </form>
        </div>
        <div class="back-link">
            <a href="admin_dashboard.php">Back</a>
        </div>
    </div>
</body>
</html>
