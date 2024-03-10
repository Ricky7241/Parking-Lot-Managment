<?php
// Include the header
include 'header.php';

// Include database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve hashed password from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, login successful
            echo "Login successful";
            // Redirect user to dashboard or homepage
            header("Location: user_dashboard.php");
            exit();
        } else {
            // Password is incorrect
            echo "Incorrect password";
        }
    } else {
        // User not found
        echo "User not found";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <h2>User Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="signup-link">
        <a href="signup.php">Sign Up</a>
    </div>
</div>

</body>
</html>
