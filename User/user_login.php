<?php

include '../db_connect.php';
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
          
            header("Location: user_info.php");
            exit();
        } else {
         
            $error_message = "Incorrect password";
        }
    } else {
       
        $error_message = "User not found";
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
<link rel="stylesheet" href="../styles.css">
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
        top: calc(100% + 10px);        
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
</head>
<body>
<a href="http://localhost/Projecyt%20to%20share/PROJECT/index.php" class="back-button"> Back</a>
<div class="login-container <?php if(!empty($error_message)) echo 'error-shake'; ?>">
    <?php
    if (!empty($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>
    <h2>User Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="forgot-password">
        <a href="user_forgot_password.php">Forgot Password?</a>
    </div>
    <div class="signup-link">
        <a href="signup.php">Sign Up</a>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const errorMessage = document.querySelector('.error-message');
        if(errorMessage.textContent !== '') {
            errorMessage.style.bottom = '20px'; 
        }
    });
</script>
</body>
</html>
