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
</head>
<body>
    <h1>Settings</h1>
    <form action="settings.php" method="POST">
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
                        <option value="GMT+12" <?php if($time_zone == 'GMT+12') echo 'selected'; ?>>GMT+12</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Set Currency:</td>
                <td>
                    <select name="currency">
                        <option value="USD" <?php if($currency == 'USD') echo 'selected'; ?>>United States Dollar (USD)</option>
                       
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>Set Date Time Format:</td>
                <td>
                    <select name="date_time_format">
                        <option value="d/m/Y H:i:s" <?php if($date_time_format == 'd/m/Y H:i:s') echo 'selected'; ?>>d/m/Y H:i:s</option>
           
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit">Save</button>
    </form>
</body>
</html>
