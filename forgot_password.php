<?php
include 'header.php';
include 'db_connect.php';

$new_password = $confirm_password = $username = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $username = $_POST['username'];

    if (empty($new_password) || empty($confirm_password) || empty($username)) {
        $error = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$hashed_password' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['password_reset'] = true; // Set a session variable
            header("Location: admin_login.php"); // Redirect to login page
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
<title>Forgot Password</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="reset-password-container">
    <h2>Forgot Password</h2>
    <form action="reset_password.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="submit" value="Reset Password" >
    </form>
</div>

</body>
</html>

















