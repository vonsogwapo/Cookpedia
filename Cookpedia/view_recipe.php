<!DOCTYPE html>
<html>
<head>
    <title>Landing - Cookpedia</title>
    <link href="style.css" type="text/css" rel="stylesheet">
    <style>
        /* Adjust the width of the recipe image */
        img.recipe-image {
            max-width: 400px;
            max-height: 240px;
            border-radius: 15px;
        }
        img.back-icon {
            max-width: 30px;
            max-height: 30px;
        }
        img.edit_icon {
            max-width: 20px;
            max-height: 20px;
        }
        img.delete_icon{
            max-width: 20px;
            max-height: 20px;
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

<?php
session_start();
?>

<header>
<div id="header">
        <nav id="hnav">
        <a href="header.php"><img class="imgHeader" src="CookpediaLogo.png" alt="Cookpedia Logo"></a>
                <ul id="h-ul">
                <li><a href="header.php">Home</a></li>
                    <li><a href="--" id="h-about-us">About Us</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="dropdown">
                            <a href="#" class="active" id="usernameDropdown">
                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                <li><a href="view_profile.php" class="vp-w">View Profile</a></li>
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
// Retrieve the recipe ID from the query string
$recipe_id = $_GET['id'];

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Cookpedia_db";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the recipe details from the database
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = :recipe_id");
    $stmt->bindParam(':recipe_id', $recipe_id);
    $stmt->execute();

    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
        // Display the recipe details
        $recipeName = $recipe['recipe_name'];
        $ingredients = $recipe['ingredients'];
        $steps = $recipe['steps'];
        $image = $recipe['image'];
        $username = $recipe['username'];

        // Display the recipe details
                     
        echo "<div class='rec-container'>";
        
        echo "<a href='header.php' class='back-link'><button id='back-icon' class='back'><img src='back-icon.png' class='back-icon'></button></a>";

        echo "<div class='reci-name'>";
                echo "<h1>".$recipe['recipe_name']."</h1>";
            echo "<div class='reci-btn'>";
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
            // Display the edit and delete buttons
            $loggedInUsername = $_SESSION['username'];

            if ($loggedInUsername === $username) {
                // Only display the buttons for the recipe owner
                // Edit and delete buttons
                echo "<a href='edit_recipe.php?recipe_id=".$recipe_id."' class='edit-button'><img src='edit_icon.png' class='edit_icon'></a>";
                echo "<a href='delete_recipe.php?id=".$recipe_id."' class='delete-button'><img src='delete_icon.png' class='delete_icon'></a>";
            }
        }
    } else {
        echo "<p>Recipe not found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
            echo "</div>";  
        echo "</div>";

    echo "<div class='rec-row'>";   
        echo "<div class='reci-ing'>";
            echo "<h2>Ingredients</h2> <p>" . nl2br($recipe['ingredients']) . "</p>";
        echo "</div>";         
            echo "<div class='reci-img'>";
                echo "<img src='".$recipe['image']."' alt='Recipe Image' class='recipe-image'>";
            echo "</div>";        
    echo "</div>";

        echo "<div class='reci-steps'>";
            echo "<h2>Steps</h2> <p>" . nl2br($recipe['steps']) . "</p>";
        echo "</div>";

        echo "<p>Uploaded by: $username</p>";

    echo "</div>";
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
