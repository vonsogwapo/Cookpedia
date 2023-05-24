<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an administrator
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. You need to be an administrator to view this page.";
    exit;
}

// Assuming you have a database connection
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

// Check if the user ID is provided
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Delete the user from the database
    $query = "DELETE FROM users WHERE id='$userId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // User deleted successfully
        header("Location: view_all_users.php");
        exit;
    } else {
        echo "Error deleting the user: " . mysqli_error($conn);
    }
} else {
    echo "User ID parameter not provided.";
}

mysqli_close($conn);
?>
