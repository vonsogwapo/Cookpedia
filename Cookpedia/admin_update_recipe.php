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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the recipe ID is provided
    if (isset($_POST['id'])) {
        $recipeId = $_POST['id'];

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

        // Retrieve the recipe details from the database
        $query = "SELECT * FROM recipes WHERE id='$recipeId'";
        $result = mysqli_query($conn, $query);

        // Check if the recipe exists
        if (mysqli_num_rows($result) > 0) {
            // Get the updated recipe details from the form
            $recipeName = $_POST['recipe_name'];
            $ingredients = $_POST['ingredients'];
            $steps = $_POST['steps'];
            
            // Check if a new image is uploaded
            $imagePath = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $imagePath = "images/" . $image['name'];
                
                // Move the uploaded image to the desired location
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            // Update the recipe in the database
            $updateQuery = "UPDATE recipes SET recipe_name='$recipeName', ingredients='$ingredients', steps='$steps'";
            if (!empty($imagePath)) {
                $updateQuery .= ", image='$imagePath'";
            }
            $updateQuery .= " WHERE id='$recipeId'";
            
            if (mysqli_query($conn, $updateQuery)) {
                echo "Recipe updated successfully.";
                // Redirect back to view_recipe.php
                header("Location: view_all_recipes.php?id=$recipeId");
                exit;
            } else {
                echo "Error updating recipe: " . mysqli_error($conn);
            }
        } else {
            echo "Recipe not found.";
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "Invalid recipe ID.";
    }
} else {
    echo "Invalid request.";
}
?>
