<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the user ID from the session
$userId = $_SESSION['user_id'];

// Delete the user account from the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cookpedia_db';

// Establish a database connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete the user account
$query = "DELETE FROM users WHERE id='$userId'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Account deleted successfully
    // You can redirect the user to a login page or show a success message
    session_destroy(); // Destroy the session
    header("Location: login.php");
    exit;
} else {
    // Error occurred while deleting the account
    // You can redirect the user to their profile page or show an error message
    header("Location: view_profile.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
