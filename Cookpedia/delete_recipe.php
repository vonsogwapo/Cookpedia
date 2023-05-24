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
    $confirmUrl = "delete_recipe_confirm.php?id=".$recipeId;

    // Display the confirmation prompt
    echo "<script>
            if (confirm('Are you sure you want to delete this recipe?')) {
                window.location.href = '".$confirmUrl."';
            } else {
                window.location.href = 'view_recipe.php?id=".$recipeId."';
            }
          </script>";
} else {
    echo "<p>Invalid recipe ID.</p>";
}
?>
