<?php
session_start();
// Retrieve the recipes from the database
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

// Retrieve the recipes
$query = "SELECT * FROM recipes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Recipes</title>
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
    function editRecipe(recipeId) {
        if (confirm("Are you sure you want to edit this recipe?")) {
            window.location.href = "admin_edit_recipe.php?recipe_id=" + recipeId;
        }
    }
    </script>
    
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

<div class="table-container">
    <h1>All Recipes</h1>
    <table class="recipe-table">
        <tr>
            <th>Recipe Name</th>
            <th>Author</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $recipeId = $row['id'];
                $recipeName = $row['recipe_name'];
                $recipeAuthor = $row['username'];
                ?>
                <tr>
                    <td><a href="view_recipe.php?id=<?php echo $recipeId; ?>"><?php echo $recipeName; ?></a></td>
                    <td><?php echo $recipeAuthor; ?></td>
                    <td>
                        <a href="admin_edit_recipe.php?recipe_id=<?php echo $recipeId; ?>" class="action-btn">Edit Recipe</a>
                        <a href="admin_delete_recipe.php?id=<?php echo $recipeId; ?>" onclick="return confirm('Are you sure you want to delete this recipe?')" class="del-action-btn">Delete Recipe</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="3">No recipes found.</td>
            </tr>
            <?php
        }
        ?>
    </table>
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

<?php
mysqli_close($conn);
?>