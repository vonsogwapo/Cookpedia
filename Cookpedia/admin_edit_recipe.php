<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Recipe - Cookpedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
    <style>
        body{
            overflow-x:hidden;
        }
        img.back-icon {
            max-width: 30px;
            max-height: 30px;
        }
        /* Adjust the width of the recipe image */
        img.recipe-image {
        max-width: 400px;
        max-height: 240px;
        border-radius: 15px;
        }
    </style>
</head>

<body>

<header>
<div id="header">
        <nav id="hnav">
        <a href="view_all_users.php"><img class="imgHeader" src="CookpediaLogo.png" alt="Cookpedia Logo"></a>
                <ul id="h-ul">
                <li><a href="view_all_users.php">All Accounts</a></li>
                    <li><a href="view_all_recipes.php">All Recipes</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="dropdown">
                            <a href="#" class="active" id="usernameDropdown">
                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                <!-- <li><a href="view_profile.php" class="vp-w">View Profile</a></li> -->
                                <!-- <li><a class="dropdown-item" href="upload_recipe.php">Upload Recipe</a></li> -->
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a class="active" href="signup.php" id="h-getStarted">Get Started</a></li>
                    <?php endif; ?>  
                </ul> 
            
        </nav>
    </div> 
</header>


<?php

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

// Check if the recipe ID is provided
if (isset($_GET['recipe_id'])) {
    $recipeId = $_GET['recipe_id'];

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
        $row = mysqli_fetch_assoc($result);
        $recipeName = $row['recipe_name'];
        $ingredients = $row['ingredients'];
        $steps = $row['steps'];
        $imagePath = $row['image'];

        // Display the recipe editing form
        echo "<div class='container_up'>";
        echo "<div class='row'>";
            echo "<a href='view_recipe.php?id=$recipeId' class='back-link'><button id='back-icon' class='back'><img src='back-icon.png' class='back-icon'></button></a>";


            echo "<form action='admin_update_recipe.php' method='post' enctype='multipart/form-data'>";
                echo "<div class='rec-in'>";
                    echo "<input type='hidden' name='id' value='$recipeId'>";
                    echo "<h2 class='rec_title'>Recipe Name <input type='text' id='recipe_name' name='recipe_name' value='$recipeName'></h2><br>";
                echo "</div>";

                echo "<div class='mb-3'>";
                    echo "<h4 class='ing'>Ingredients</h4> <textarea name='ingredients' rows='5'>$ingredients</textarea>";
                echo "</div>";   

                echo "<div class='mb-3'>";    
                    echo "<h4 class='steps'>Steps</h4> <textarea name='steps' rows='10'>$steps</textarea>";
                echo "</div>";  

                
                    echo "<h4 class='cur-im'>Current Image: </h4>";
                echo "<div class='mb-5'>";
                    if (!empty($imagePath) && file_exists($imagePath)) {
                        echo "<img src='$imagePath' alt='Recipe Image' class='recipe-image'>";
                    } else {
                        
                            echo "No image available";
                            echo "Image Path: $imagePath";
                        
                    }
                    echo "<div class='mb-6'>";
                    echo "<p class='rep-text'>Replace/Add Image</p> <input type='file' name='image'>";
                    echo "</div>";
                echo "</div>";
                
                    echo "<button type='submit' class='publish-btn'>Update Recipe</button>";
            echo "</form>";


        echo "</div>";    
    echo "</div>";
    } else {
        echo "<p>Recipe not found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "<p>Invalid recipe ID.</p>";
}
?>


<footer class="footer">
<div id="f-footer">
        <img class="mainLogo" src="CookpediaMainLogo.png"/>
        <div id="f-content">
            <div id="f-content-2">

                <div id="f-aboutus">
                        <p id="f-about">About Us</p>
                    <ul id="f-aboutCookpedia">
                        <li><a href="--" id="f-cookpedia">About Cookpedia</a></li>
                   </ul>
                </div>
                 
                <div id="f-info">
                        <p id="f-contact">Contact Us</p>
                    <div class="logo">
                        <a href="--"><img class="f-linkedIn" src="LinkedInLogo.png"></a>
                        <a href="--"><img class="f-twitter" src="TwitterLogo.png"></a>
                        <a href="--"><img class="f-ig" src="IgLogo.png"></a>
                        <a href="--"><img class="f-fb" src="FbLogo.png"></a>
                    </div>
                        <p id="f-text">2022 ©delicook.com All right <br>reserved.</p>
                </div> 
            </div>     
        </div>  
    </div>
</footer>

</body>
</html>