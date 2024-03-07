<?php
// Include the header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <h2>User Registration</h2>
    <form action="register_process.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>
