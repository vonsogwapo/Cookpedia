<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the recipe ID is provided
if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];

    // Database connection variables
    $servername = "localhost";
    $dbname = "Cookpedia_db";
    $dbusername = "root";
    $dbpassword = "";

    // Establish a database connection
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete the recipe from the database
    $query = "DELETE FROM recipes WHERE id='$recipeId' AND username='{$_SESSION['username']}'";
    $result = mysqli_query($conn, $query);

    // Check if the deletion was successful
    if ($result) {
        // Redirect to the recipes list page
        header("Location: view_profile.php");
        exit;
    } else {
        echo "<p>Error deleting recipe.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "<p>Invalid recipe ID.</p>";
}
?>
