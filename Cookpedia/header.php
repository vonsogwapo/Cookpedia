<!DOCTYPE html>
<html>
<head>
    <title>Landing - Cookpedia</title>
    <link href="style.css" type="text/css" rel="stylesheet">
    <style>
        /* Adjust the width of the icon image */
        img.edit_icon {
            max-width: 20px;
            max-height: 20px;
        }
        /* Adjust the width of the recipe image */
        img.recipe-image {
            width: 280px;
            height: 195px;
            max-width: 280px;
            max-height: 195px;
            border-radius: 15px 15px 0 0;
        }   
    </style>
    <script>
    document.getElementById('usernameDropdown').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
    });
    </script>
    
</head>

<body>

<!-- header.php -->
<?php
session_start();
// Define the $is_admin variable based on your authentication mechanism
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>


<header>
    <div id="header">
        <nav id="hnav">
            <a href="<?php echo $is_admin ? 'view_all_users.php' : 'header.php'; ?>">
                <img class="imgHeader" src="CookpediaLogo.png" alt="Cookpedia Logo">
            </a>
            <ul id="h-ul">
                <?php if ($is_admin): ?>
                    <li><a href="view_all_users.php">All Accounts</a></li>
                    <li><a href="view_all_recipes.php">All Recipes</a></li>
                <?php else: ?>
                    <li><a href="header.php">Home</a></li>
                    <li><a href="--" id="h-about-us">About Us</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])): ?>
                    <li class="dropdown">
                        <a href="#" class="active" id="usernameDropdown">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <?php if ($is_admin): ?>
                                <!-- <li><a href="view_profile.php" class="vp-w">View Profile</a></li> -->
                                <!-- <li><a class="dropdown-item" href="upload_recipe.php">Upload Recipe</a></li> -->
                            <?php else: ?>
                                <li><a href="view_profile.php" class="vp-w">View Profile</a></li>
                            <?php endif; ?>
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
// Retrieve the uploaded recipes
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

// Define the $loggedIn variable based on your authentication mechanism
$loggedIn = isset($_SESSION['user_id']); // Adjust this based on your session variable

// Define the $ownedRecipesResult variable if the user is logged in
if ($loggedIn) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM recipes WHERE username = '$username'";
    $ownedRecipesResult = mysqli_query($conn, $query);
}
// Retrieve the uploaded recipes
$query = "SELECT * FROM recipes";
$result = mysqli_query($conn, $query);


?>

<div class="land-container">
    <?php
    // Check if the user is logged in
    if ($loggedIn) {
        // Display "My Recipes" section
        if ($ownedRecipesResult) {
            ?>
            <div class="myrecipe-btn">
            <h2 class="rec-con">My Recipes</h2>
            <a class="new-recipe" href="upload_recipe.php"><button class="add-new">+ New Recipe</button></a>
        </div>
            <div class="recipe-container-card">
                <?php
                // Check if any recipes were found
                if (mysqli_num_rows($ownedRecipesResult) > 0) {
                    while ($row = mysqli_fetch_assoc($ownedRecipesResult)) {
                        $recipeId = $row['id'];
                        $recipeName = $row['recipe_name'];
                        $recipeOwner = $row['username'];
                        $recipeImage = $row['image'];

                        // If the recipe image exists, update the image path
                        if ($recipeImage) {
                            $recipeImagePath = "" . $recipeImage;
                        } else {
                            // If no image is available, you can use a placeholder image or display a default image
                            $recipeImagePath = "path/to/placeholder/image.png"; // Replace with the path to your placeholder image
                        }
                        ?>
                        <div class="cards">
                            <img src="<?php echo $recipeImagePath; ?>" alt="Recipe Image" class="recipe-image">
                            <div class="card-info">
                                <div class="recipe-title"><?php echo $recipeName; ?></div>
                                <a href="view_recipe.php?id=<?php echo $recipeId; ?>" class="view-recipe-btn">View Recipe</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='no-recipe'>Hmm, it looks like your recipe collection is waiting to be filled.</p>";
                }
                ?>
            </div>
            <?php
        }
    } else {
        // Display welcome section for non-logged in users
        ?>
        <div class="welcome">
            <div class="welcome-message">
                <p class="wel">Welcome to Cookpedia</p>
                <p class="par1">Delicious Recipes For You and Your Family</p>
                <li><a class="active" href="signup.php" id="land-getStarted">Get Started</a></li>  
            </div>
            <div class="welcome-images">
                <img src="sample1.jpg" class="sample1">
                <img src="sample2.jpg" class="sample2">
                <img src="sample3.jpg" class="sample3">
            </div>
        </div>
        <?php
    }
    ?>

    <h2 class="rec-con">Popular Recipes</h2>
    <div class="recipe-container-card">
        <?php
        // Retrieve the popular recipes
        $query = "SELECT * FROM recipes";
        $result = mysqli_query($conn, $query);

        // Check if any recipes were found
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $recipeId = $row['id'];
                $recipeName = $row['recipe_name'];
                $recipeOwner = $row['username'];
                $recipeImage = $row['image'];

                // If the recipe image exists, update the image path
                if ($recipeImage) {
                    $recipeImagePath = "" . $recipeImage;
                } else {
                    // If no image is available, you can use a placeholder image or display a default image
                    $recipeImagePath = "path/to/placeholder/image.png"; // Replace with the path to your placeholder image
                }
                ?>
                <div class="cards">
                    <img src="<?php echo $recipeImagePath; ?>" alt="Recipe Image" class="recipe-image">
                    <div class="card-info">
                        <div class="recipe-title"><?php echo $recipeName; ?></div>
                        <div class="recipe-owner">By: <?php echo $recipeOwner; ?></div>
                        <a href="view_recipe.php?id=<?php echo $recipeId; ?>" class="view-recipe-btn">View Recipe</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Hmm, it looks like the recipe collection is waiting to be filled.</p>";
        }
        ?>
    </div>
</div>


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
