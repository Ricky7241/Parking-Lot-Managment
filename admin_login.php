<?php

include 'db_connect.php';

if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
    $error_message = "You are not the admin";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }
    .login-container {
        position: relative;
        max-width: 500px;
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    h2 {
        margin-bottom: 20px;
    }
    .error-message {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        color: red;
        font-size: 14px;
        transition: bottom 0.3s ease;
    }
    @keyframes shake {
        0% { transform: translateX(0); }
        20% { transform: translateX(-10px); }
        40% { transform: translateX(10px); }
        60% { transform: translateX(-10px); }
        80% { transform: translateX(10px); }
        100% { transform: translateX(0); }
    }
    .error-shake {
        animation: shake 0.5s;
    }
    .logo {
        font-size: 24px;
        font-weight: bold;
    }
    input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .back-button:hover {
        background-color: #45a049;
    }
</style>
<script>
    $(document).ready(function(){
        function shakeLoginContainer() {
            $('.login-container').addClass('error-shake');
            setTimeout(function(){
                $('.login-container').removeClass('error-shake');
            }, 1000);
        }
        let errorMessage = "<?php echo $error_message; ?>";
        if (errorMessage !== "") {
            shakeLoginContainer();
            $('#username').val('');
            $('#password').val('');
            $('#username').focus();
        }
    });
</script>
</head>
<body>
<a href="http://localhost/Projecyt%20to%20share/PROJECT/index.php" class="back-button">Back</a>
<div class="login-container">
    <?php
    if (!empty($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>
    <h2>Admin Login</h2>
    <form action="admin_login_process.php" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="forgot-password">
        <a href="forgot_password.php">Forgot Password?</a>
    </div>
</div>
<?php
    if (!empty($password_reset_message)) {
        echo '<p class="success-message">' . $password_reset_message . '</p>';
    }
    ?>
</body>
</html>

