<?php
// Enable detailed error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();  // Ensure session is started before using session variables

// Include the connection.php file properly. Assuming it's in the parent directory
require_once "../connection.php";  // Correct the path to the connection.php file

// Check if connection is established
if ($con) {
    // Get unique_id from session, if set
    $unique_id = isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : '';

    // If unique_id is set, sanitize it
    if ($unique_id) {
        $unique_id = mysqli_real_escape_string($con, $unique_id);

        // Example of a query to update user status on logout (uncomment and modify if needed)
        // $query = "UPDATE usertable SET active='offline' WHERE unique_id='$unique_id'";
        // mysqli_query($con, $query);
    }
} else {
    die("Database connection failed: " . mysqli_connect_error());
}

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: ../login-user.php');  // Adjust path if login-user.php is in a different directory
exit();  // It's a good practice to call exit() after header redirection
?>
