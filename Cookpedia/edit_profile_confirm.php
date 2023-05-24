<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit;
}

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'Cookpedia_db';

// Establish a database connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$displayName = $_POST['display_name'];
$email = $_POST['email'];

// Update the user's profile in the database
$username = $_SESSION['username'];
$query = "UPDATE users SET display_name='$displayName', email='$email' WHERE username='$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Profile updated successfully
    // Redirect to the profile page or display a success message
    header("Location: view_profile.php");
    exit;
} else {
    // Error occurred during profile update
    echo 'Error: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
