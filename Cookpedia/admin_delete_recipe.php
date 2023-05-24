<?php
session_start();
// Check if the recipe ID is provided in the URL
if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];

    // Establish a database connection
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'cookpedia_db';

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete the recipe from the database
    $deleteQuery = "DELETE FROM recipes WHERE id = $recipeId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Check if the deletion was successful
    if ($deleteResult) {
        mysqli_close($conn);
        header("Location: view_all_recipes.php");
        exit();
    } else {
        echo "Error deleting recipe: " . mysqli_error($conn);

    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Recipe ID not provided.";
}
?>
