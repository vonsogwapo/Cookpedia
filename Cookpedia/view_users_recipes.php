<?php
session_start();

// Assuming you have a database connection
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

// Check if the user ID is provided
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Retrieve the user's information from the database
    $query = "SELECT * FROM users WHERE id='$userId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $displayName = $user['username']; // Get the owner's display name

        // Retrieve the user's recipes from the database
        $query = "SELECT r.id, r.recipe_name, r.ingredients, r.steps, r.image FROM recipes r JOIN users u ON r.username = u.username WHERE u.id='$userId'";
        $result = mysqli_query($conn, $query);

        ?>

<!DOCTYPE html>
<html>
<head>
    <title>User Recipes</title>
    <link href="style.css" type="text/css" rel="stylesheet">
    <style>
        .recipe-card {
            width: 280px;
            background-color: rgb(253, 250, 250);
            border-radius: 10px;
            padding-bottom: 10px;
            margin-left: 0.3in;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .recipe-card img {
            width: 280px;
            height: 195px;
            object-fit: cover;
            border-radius: 5px 5px 0 0;
        }

        .recipe-card .card-body {
            padding: 10px;
            
        }

        .recipe-card h5 {
            margin: 0;
            padding-bottom: 20px;
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

<div class="land-container">
<?php if (mysqli_num_rows($result) > 0) : ?>
<h2 class="rec-owner"><?php echo $displayName; ?>'s Recipes</h2>
            
    <div class="recipe-container-card">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="col-md-4">
                <div class="card recipe-card">
                    <?php if (!empty($row['image']) && file_exists($row['image'])) : ?>
                        <img src="<?php echo $row['image']; ?>" alt="Recipe Image">
                    <?php else : ?>
                        <img src="placeholder-image.jpg" alt="Recipe Image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['recipe_name']; ?></h5>
                        <a href="view_recipe.php?id=<?php echo $row['id'];?>" class="view-recipe-btn">View Recipe</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
            <?php else: ?>
                <p><?php echo $displayName ?> doesn't have uploaded recipes.</p>
            <?php endif; ?>
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
<script>
    function editRecipe(recipeId) {
        if (confirm("Are you sure you want to edit this recipe?")) {
            window.location.href = "admin_edit_recipe.php?recipe_id=" + recipeId;
        }
    }

    function deleteRecipe(recipeId) {
        if (confirm("Are you sure you want to delete this recipe?")) {
            window.location.href = "admin_delete_recipe.php?recipe_id=" + recipeId;
        }
    }
</script>
        <?php
    } else {
        echo "Invalid user ID.";
    }
} else {
    echo "User ID parameter not provided.";
}

mysqli_close($conn);
?>