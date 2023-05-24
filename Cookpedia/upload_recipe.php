<?php
// Check if the user is logged in
session_start();
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
    
    </style>
</head>

<body>

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
                        <li><a class="active" href="--" id="h-getStarted">Get Started</a></li>
                    <?php endif; ?>  
                </ul> 
            
        </nav>
    </div> 
</header>




<div class="container_up">
    <div class="row">
        <a href="view_profile.php" class="back-link">
            <button id="back-icon" class="back">
                <img src="back-icon.png" class="back-icon">
            </button>
        </a>

        <form action="upload_process.php" method="post" enctype="multipart/form-data">
            <div class="rec-in">
                <h2 class="rec_title">Recipe Name</h2>
                <input type="text" class="form-control" id="recipe_name" name="recipe_name" required>
            </div>

            <div class="mb-4">
                <h4 class="uplo">Upload Image:</h4>
                <div class="upload-box" data-text="Upload">
                    <input type="file" class="file-upload-field" id="up-image" name="image" accept="image/*" required>
                </div>
            </div>

            <div class="mb-3">
                <h4 class="ing">Ingredients</h4>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <h4 class="steps">Steps</h4>
                <textarea class="form-control" id="steps" name="steps" rows="5" required></textarea>
            </div>

            <button type="submit" class="publish-btn">Publish Recipe</button>
        </form>
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