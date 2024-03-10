<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // Function to shake login container
        function shakeLoginContainer() {
            $('.login-container').addClass('shake');
            setTimeout(function(){
                $('.login-container').removeClass('shake');
            }, 1000);
        }

        // If there's an error parameter in URL indicating invalid credentials, shake the login container
        let urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error') && urlParams.get('error') === 'invalid_credentials') {
            shakeLoginContainer();
            // Clear input fields
            $('#username').val('');
            $('#password').val('');
            // Focus on username field
            $('#username').focus();
        }
    });
</script>
</head>
<body>
<?php
// Include the header
include 'header.php';
?>


<div class="login-container">
    <h2>Admin Login</h2>
    <?php
    // Display error message if invalid credentials error is present in URL
    if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
        echo '<p style="color: red;">You are not the admin</p>';
    }
    ?>
    <form action="admin_login_process.php" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="forgot-password">
        <a href="forgot_password.php">Forgot Password?</a>
    </div>
</div>

</body>
</html>
