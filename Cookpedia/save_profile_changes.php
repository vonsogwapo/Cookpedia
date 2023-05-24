<?php
// Assuming you have a database connection
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

// Retrieve the updated profile values from the POST data
$updatedDisplayName = $_POST['display_name'];
$updatedUsername = $_POST['username'];
$updatedEmail = $_POST['email'];

// Retrieve the user ID from the session
session_start();
$userId = $_SESSION['user_id'];

// Update the user's profile information in the database
$query = "UPDATE users SET display_name='$updatedDisplayName', username='$updatedUsername', email='$updatedEmail' WHERE id='$userId'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Profile changes saved successfully
    // You can perform any additional actions or show a success message if needed
    echo "Profile changes saved successfully.";
} else {
    // Error occurred while saving profile changes
    // You can handle the error or show an error message if needed
    echo "Error occurred while saving profile changes: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
