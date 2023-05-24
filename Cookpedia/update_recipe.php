<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the recipe ID and updated recipe details are provided
if (isset($_POST['id']) && isset($_POST['recipe_name']) && isset($_POST['ingredients']) && isset($_POST['steps'])) {
    $recipeId = $_POST['id'];
    $recipeName = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $steps = $_POST['steps'];

    // Database connection variables
    $servername = "localhost";
    $dbname = "cookpedia_db";
    $dbusername = "root";
    $dbpassword = "";

    // Establish a database connection
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if a new image file is uploaded
    if (!empty($_FILES['image']['name'])) {
        // Remove the old image file if it exists
        $query = "SELECT image FROM recipes WHERE id='$recipeId' AND username='{$_SESSION['username']}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $oldImagePath = $row['image'];
        if (!empty($oldImagePath) && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        // Upload the new image file
        $imagePath = "images/" . basename($_FILES['image']['name']);

        // Check if the uploaded file is within the allowed size
        if ($_FILES['image']['size'] <= 2 * 1024 * 1024) { // 2MB limit
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                // Update the recipe details and image path in the database
                $query = "UPDATE recipes SET recipe_name='$recipeName', ingredients='$ingredients', steps='$steps', image='$imagePath' WHERE id='$recipeId' AND username='{$_SESSION['username']}'";
                $result = mysqli_query($conn, $query);

                // Check if the update was successful
                if ($result) {
                    // Redirect back to the view_recipe.php page
                    header("Location: view_recipe.php?id=$recipeId");
                    exit;
                } else {
                    echo "Error updating recipe: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Image size exceeds the limit. Please upload an image below 2MB.";
        }
    } else {
        // Update the recipe details without changing the image path in the database
        $query = "UPDATE recipes SET recipe_name='$recipeName', ingredients='$ingredients', steps='$steps' WHERE id='$recipeId' AND username='{$_SESSION['username']}'";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
            // Redirect back to the view_recipe.php page
            header("Location: view_recipe.php?id=$recipeId");
            exit;
        } else {
            echo "Error updating recipe: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid recipe details.";
}
?>
