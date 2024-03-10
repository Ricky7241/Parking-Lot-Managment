<?php include 'header.php'; 
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: user_login.php");
    exit();
}
?>
<div class="container">
    <h2>Your Dashboard Content Goes Here</h2>
    <!-- Other dashboard content -->
</div>

</body>
</html>
