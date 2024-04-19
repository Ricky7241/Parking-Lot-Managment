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



$new_password = $confirm_password = $error = "";

session_start();
if (!isset($_SESSION['reset_username'])) {
    header("Location: user_forgot_password.php"); // Redirect to forgot password page if username is not set in session
    exit();
}

$username = $_SESSION['reset_username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$hashed_password' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            // Password reset successful, unset the session variable
            unset($_SESSION['reset_username']);
            header("Location: user_login.php"); // Redirect to login page
            exit();
        } else {
            $error = "Error updating password: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="password" name="new_password" placeholder="New Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
