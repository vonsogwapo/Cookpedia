<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the logged-in username
$username = $_SESSION['username'];

// Retrieve the recipe details from the form
$recipe_name = $_POST['recipe_name'];
$ingredients = $_POST['ingredients'];
$steps = $_POST['steps'];

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Cookpedia_db";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Upload image file
    $targetDir = "images/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow only specific image file types
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileType, $allowedTypes)) {
        // Check if the file size is below 2MB
        if ($_FILES["image"]["size"] <= 2 * 1024 * 1024) {
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Prepare the SQL statement
                $stmt = $conn->prepare("INSERT INTO recipes (username, recipe_name, ingredients, steps, image, created_at) VALUES (:username, :recipe_name, :ingredients, :steps, :image, :created_at)");

                // Bind the parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':recipe_name', $recipe_name);
                $stmt->bindParam(':ingredients', $ingredients);
                $stmt->bindParam(':steps', $steps);
                $stmt->bindParam(':image', $targetFilePath);
                $stmt->bindParam(':created_at', $currentDateTime);

                // Execute the statement
                $stmt->execute();

                // Retrieve the generated recipe ID
                $recipeId = $conn->lastInsertId();

                // Redirect to the view_recipe page with the generated recipe ID
                header("Location: view_recipe.php?id=" . $recipeId);
                exit;
            }
        } else {
            echo "Error: File size exceeds the limit.";
        }
    } else {
        echo "Error: Invalid file type. Allowed types are jpg, jpeg, png, and gif.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
