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







$username = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    if (empty($username)) {
        $error = "Username is required.";
    } else {
        // Check if the username exists in the database
        $check_username = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($check_username);
        if ($result->num_rows > 0) {
            // Set a session variable to store the username for password reset
            session_start();
            $_SESSION['reset_username'] = $username;
            header("Location: user_reset_password.php"); // Redirect to reset password page
            exit();
        } else {
            $error = "Username not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
