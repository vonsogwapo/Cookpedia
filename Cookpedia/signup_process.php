<?php

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
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$email = $_POST['email'];

// Check if the password and confirm password match
if ($password !== $confirmPassword) {
    echo 'Passwords do not match.';
    exit;
}

// Insert the user data into the database
$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
$result = mysqli_query($conn, $query);

if ($result) {
    // Sign up successful, display success message
    echo 'Sign up successful. You will be redirected to the login page in a few seconds.';

    // Redirect to the login page after a delay
    echo '<script>
        setTimeout(function() {
            window.location.href = "login.php";
        }, 3000); // Redirect after 3 seconds
    </script>';
} else {
    // Error occurred during sign up
    echo 'Error: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
