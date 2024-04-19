<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the profile table
    $sql = "SELECT * FROM profile WHERE reset_token = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Token is valid, show password reset form
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
            <form action="update_password.php" method="post">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="password" name="new_password" placeholder="New Password" required><br>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
                <input type="submit" value="Reset Password">
            </form>
        </div>

        </body>
        </html>

        <?php
    } else {
        echo "Invalid reset token.";
    }
}

?>
