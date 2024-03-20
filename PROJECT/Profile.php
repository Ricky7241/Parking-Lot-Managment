<?php
// Database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_authentication";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the admin data from the database
$sql = "SELECT * FROM profile WHERE id = 1"; // Assuming the admin's id is 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $password = $row["password"];
} else {
    echo "Admin not found";
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Update the admin's profile in the database
    $sql = "UPDATE profile SET email='$email', password='$password' WHERE id=1"; // Assuming the admin's id is 1
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Profile Updated</h1>";
        echo "<p>Email: $email</p>";
        echo "<p>Password: ****</p>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
    exit; // Exit after processing the form data
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <!-- Edit Profile Section -->
    <div>
        <h2>Edit Profile</h2>
        <form action="profile.php" method="POST">
            <label for="email">Email address:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>" required><br><br>

            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
