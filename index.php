<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
        video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
       
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }
      
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
       
        .header-text {
            text-align: center;
            flex-grow: 1;
        }
       
        .welcome-container {
          
            position: relative;
            z-index: 1; 
            text-align: center;
            color: white; 
            padding: 20px;
            margin-top: 100px;
        }
       
        .welcome-container h2 {
            color: black;
            font-size: 2rem;
            margin-bottom: 20px;
        }
       
        .login-button {
            background-color: #000000;
            color: #eee;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin: 0 10px;
        }
        
        .login-button:hover {
            background-color: #37c4f3;
        }
        
        .button-container {
            margin-top: 30px;
        }
      
        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    
    <div class="header-text">SAARG PARKING SOLUTIONS</div>
</header>
<div class="welcome-container">
<h2 class="me" style="color: white;"><b>Welcome to SAARG Parking Solutions</b></h2>
    <div class="button-container">
        <button class="login-button" onclick="location.href='User/user_login.php'">User Login</button>
        <button class="login-button" onclick="location.href='admin_login.php'">Admin Login</button>
    </div>
</div>
<video autoplay loop muted>
    <source src="production_id_3848792 (2160p).mp4" type="video/mp4">
</video>
<footer>
    &copy; 2024 SAARG Parking Solutions. All rights reserved.
</footer>
</body>
</html>