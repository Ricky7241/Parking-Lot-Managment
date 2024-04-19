<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    .back-button {
        background-color: #f44336;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .back-button:hover {
        background-color: #f44336;
    }
</style>
    
</head>
<body>

<div class="container">
    <h2>Register</h2>
    <form action="register_process.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <button type="submit">Register</button>
    </form>
    <button class="back-button" onclick="window.history.back()">Back</button>
</div>

</body>
</html>
