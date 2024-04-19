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

$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$username = $_POST['username'] ?? '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($new_password) || empty($confirm_password) || empty($username)) {
        $error = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $sql = "UPDATE profile SET password='$new_password' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully";
            echo '<br><a href="admin_login.php" style="display: inline-block; padding: 10px 20px; background-color: green; color: white; text-decoration: none; border-radius: 5px;">Back</a>';

            exit();
        } else {
            $error = "Error updating password: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="reset-password-container">
        <h2>Reset Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="new_password" placeholder="New Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <input type="submit" value="Reset Password">
            <span class="error"><?php echo $error; ?></span>
        </form>
    </div>
</body>
</html>
