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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve settings data from the form
    $parking_name = $_POST["parking_name"];
    $contact_person_name = $_POST["contact_person_name"];
    $contact_number = $_POST["contact_number"];
    $time_zone = $_POST["time_zone"];
    $currency = $_POST["currency"];
    $date_time_format = $_POST["date_time_format"];

    // Save the settings data to the database
    $sql = "UPDATE settings SET parking_name='$parking_name', contact_person_name='$contact_person_name', contact_number='$contact_number', time_zone='$time_zone', currency='$currency', date_time_format='$date_time_format' WHERE id=1"; // Assuming the settings id is 1
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Settings Updated</h1>";
        echo "<p>Parking Name: $parking_name</p>";
        echo "<p>Contact Person Name: $contact_person_name</p>";
        echo "<p>Contact Number: $contact_number</p>";
        echo "<p>Time Zone: $time_zone</p>";
        echo "<p>Currency: $currency</p>";
        echo "<p>Date Time Format: $date_time_format</p>";
    } else {
        echo "Error updating settings: " . $conn->error;
    }
    exit; // Exit after processing the form data
}

// Fetch the settings data from the database
$sql = "SELECT * FROM settings WHERE id = 1"; // Assuming the settings id is 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $parking_name = $row["parking_name"];
    $contact_person_name = $row["contact_person_name"];
    $contact_number = $row["contact_number"];
    $time_zone = $row["time_zone"];
    $currency = $row["currency"];
    $date_time_format = $row["date_time_format"];
} else {
    echo "Settings not found";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
        }
        table td {
            padding: 10px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            padding: 10px 20px;
            background-color: green; /* Green color for Save and Back button */
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: green; /* Darker green on hover */
        }
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-link a {
            padding: 10px 20px;
            background-color: green; /* Green color for Back button */
            color: #fff;
            border: none;
            border-radius: 3px;
            text-decoration: none;
        }
        .back-link a:hover {
            background-color: green; /* Darker green on hover */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Settings</h1>
    <form action="settings.php" method="POST">
    <div class="back-link">
        <a href="Settings.php">Back</a>
    </div>
        <table>
            <tr>
                <td>Parking Name:</td>
                <td><input type="text" name="parking_name" value="<?php echo $parking_name; ?>"></td>
            </tr>
            <tr>
                <td>Contact Person Name:</td>
                <td><input type="text" name="contact_person_name" value="<?php echo $contact_person_name; ?>"></td>
            </tr>
            <tr>
                <td>Contact Number:</td>
                <td><input type="text" name="contact_number" value="<?php echo $contact_number; ?>"></td>
            </tr>
            <tr>
                <td>Set TimeZone:</td>
                <td>
                    <select name="time_zone">
                        <option value="GMT-12" <?php if($time_zone == 'GMT-12') echo 'selected'; ?>>GMT-12</option>
                        <!-- Add more options as needed -->
                        <option value="GMT-11" <?php if($time_zone == 'GMT-11') echo 'selected'; ?>>GMT-11</option>
                        <option value="GMT-10" <?php if($time_zone == 'GMT-10') echo 'selected'; ?>>GMT-10</option>
                        <option value="GMT-9" <?php if($time_zone == 'GMT-9') echo 'selected'; ?>>GMT-9</option>
                        <option value="GMT-8" <?php if($time_zone == 'GMT-8') echo 'selected'; ?>>GMT-8</option>
                        <option value="GMT-7" <?php if($time_zone == 'GMT-7') echo 'selected'; ?>>GMT-7</option>
                        <option value="GMT-6" <?php if($time_zone == 'GMT-6') echo 'selected'; ?>>GMT-6</option>
                        <option value="GMT-5" <?php if($time_zone == 'GMT-5') echo 'selected'; ?>>GMT-5</option>
                        <option value="GMT-4" <?php if($time_zone == 'GMT-4') echo 'selected'; ?>>GMT-4</option>
                        <option value="GMT-3" <?php if($time_zone == 'GMT-3') echo 'selected'; ?>>GMT-3</option>
                        <option value="GMT-2" <?php if($time_zone == 'GMT-2') echo 'selected'; ?>>GMT-2</option>
                        <option value="GMT-1" <?php if($time_zone == 'GMT-1') echo 'selected'; ?>>GMT-1</option>
                        <option value="GMT" <?php if($time_zone == 'GMT') echo 'selected'; ?>>GMT</option>
                        <option value="GMT+1" <?php if($time_zone == 'GMT+1') echo 'selected'; ?>>GMT+1</option>
                        <option value="GMT+2" <?php if($time_zone == 'GMT+2') echo 'selected'; ?>>GMT+2</option>
                        <option value="GMT+3" <?php if($time_zone == 'GMT+3') echo 'selected'; ?>>GMT+3</option>
                        <option value="GMT+4" <?php if($time_zone == 'GMT+4') echo 'selected'; ?>>GMT+4</option>
                        <option value="GMT+5" <?php if($time_zone == 'GMT+5') echo 'selected'; ?>>GMT+5</option>
                        <option value="GMT+6" <?php if($time_zone == 'GMT+6') echo 'selected'; ?>>GMT+6</option>
                        <option value="GMT+7" <?php if($time_zone == 'GMT+7') echo 'selected'; ?>>GMT+7</option>
                        <option value="GMT+8" <?php if($time_zone == 'GMT+8') echo 'selected'; ?>>GMT+8</option>
                        <option value="GMT+9" <?php if($time_zone == 'GMT+9') echo 'selected'; ?>>GMT+9</option>
                        <option value="GMT+10" <?php if($time_zone == 'GMT+10') echo 'selected'; ?>>GMT+10</option>
                        <option value="GMT+11" <?php if($time_zone == 'GMT+11') echo 'selected'; ?>>GMT+11</option>
                        <option value="GMT+12" <?php if($time_zone == 'GMT+12') echo 'selected'; ?>>GMT+12</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Set Currency:</td>
                <td>
                    <select name="currency">
                        <option value="USD" <?php if($currency == 'USD') echo 'selected'; ?>>United States Dollar (USD)</option>
                        <option value="CAD" <?php if($currency == 'CAD') echo 'selected'; ?>>Canadian Dollar (CAD)</option>
                        <option value="AUD" <?php if($currency == 'AUD') echo 'selected'; ?>>Australian Dollar (AUD)</option>
                        <option value="NZD" <?php if($currency == 'NZD') echo 'selected'; ?>>New Zealand Dollar (NZD)</option>
                        <option value="INR" <?php if($currency == 'INR') echo 'selected'; ?>>Indian Rupee (INR)</option>
                        <option value="GBP" <?php if($currency == 'GBP') echo 'selected'; ?>>British Pound (GBP)</option>
                        <option value="CNY" <?php if($currency == 'CNY') echo 'selected'; ?>>Chinese Yuan (CNY)</option>
                        <option value="AED" <?php if($currency == 'AED') echo 'selected'; ?>>United Arab Emirates Dirham (AED)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Set Date Time Format:</td>
                <td>
                    <select name="date_time_format">
                        <option value="d/m/Y H:i:s" <?php if($date_time_format == 'd/m/Y H:i:s') echo 'selected'; ?>>d/m/Y H:i:s</option>
                        <option value="m/d/Y H:i:s" <?php if($date_time_format == 'm/d/Y H:i:s') echo 'selected'; ?>>m/d/Y H:i:s</option>
                        <option value="Y-m-d H:i:s" <?php if($date_time_format == 'Y-m-d H:i:s') echo 'selected'; ?>>Y-m-d H:i:s</option>
                        <option value="H:i:s d/m/Y" <?php if($date_time_format == 'H:i:s d/m/Y') echo 'selected'; ?>>H:i:s d/m/Y</option>
                        <option value="H:i:s m/d/Y" <?php if($date_time_format == 'H:i:s m/d/Y') echo 'selected'; ?>>H:i:s m/d/Y</option>
                        <option value="H:i:s Y-m-d" <?php if($date_time_format == 'H:i:s Y-m-d') echo 'selected'; ?>>H:i:s Y-m-d</option>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit">Save</button>
       
    </form>
    <div class="back-link">
        <a href="admin_dashboard.php">Back</a>
    </div>
   
</body>
</html>







<!-- // include 'db_connect.php';

// ?>

//<!DOCTYPE html>
// <html lang="en">
// <head>
// <meta charset="UTF-8">
// <meta name="viewport" content="width=device-width, initial-scale=1.0">
// <title>Reset Password</title>
// <style>
//     body {
//         font-family: Arial, sans-serif;
//         background-color: #f5f5f5;
//         margin: 0;
//         padding: 0;
//     }
//     .reset-password-container {
//         max-width: 500px;
//         margin: 100px auto;
//         padding: 20px;
//         background-color: #fff;
//         border-radius: 5px;
//         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
//         text-align: center;
//     }
//     p {
//         color: #333;
//         font-size: 18px;
//         margin-bottom: 20px;
//     }
//     .back-button {
//         display: inline-block;
//         padding: 10px 20px;
//         background-color: #4CAF50;
//         color: white;
//         text-decoration: none;
//         border-radius: 5px;
//         transition: background-color 0.3s;
//     }
//     .back-button:hover {
//         background-color: #45a049;
//     }
// </style>
// </head>
// <body>

// <div class="reset-password-container">
//     <p>Please contact your manager or supervisor to reset your password.</p>
//     <a href="admin_login.php" class="back-button">Back</a>
// </div>

// </body>
// </html> -->