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
    <title>View Profile - Cookpedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
    <style>
        /* Adjust the width of the icon image */
        img.edit_icon {
            max-width: 20px;
            max-height: 20px;
        }
        /* Adjust the width of the recipe image */
         img.recipe-image {
            max-width: 290px;
            max-height: 240px;
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

    <div class="container">
    <div class="row">
        <div class="profile-container">
            <div class="prof-edit-icon">
            <h2>Your Profile</h2>
            <button id="edit-profile-btn" class="btn btn-primary"><img src="edit_icon.png" class="edit_icon"></button>
            <button id="save-profile-btn" class="btn btn-primary" style="display: none;">Save Changes</button>           
        </div>    
                           
            <?php
            // Retrieve the user's profile information from the database
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

            // Retrieve the user's information
            $userId = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE id='$userId'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $displayName = $row['display_name'];
                $username = $row['username'];
                $email = $row['email'];

                // Display the user's information
                echo "<p><strong>Display Name</strong> <br> <span id='display-name'>$displayName<br></span></p>" ;
                echo "<p><strong>Username</strong> <br> <span id='username'>$username</span></p>";
                echo "<p><strong>Email</strong> <br> <span id='email'>$email</span></p>";

                // Display the Change Password and Delete Profile buttons
                echo '<div id="profile-actions">';
                echo '<button id="change-password-btn" class="btn btn-primary">Change Password</button>';   
                ?>

                <form id="delete-profile-form" action="view_profile.php" method="POST">
                <button id="delete-profile-btn" class="btn btn-danger" name="delete_profile">Delete Profile</button>
                <button id="save-profile-btn" class="btn btn-primary" style="display: none;">Save Changes</button>           

                </form>
                
                <?php
                echo '</div>';

                
                // Delete profile if the delete button is clicked
                if (isset($_POST['delete_profile'])) {
                    // Retrieve the user ID from the session
                    $userId = $_SESSION['user_id'];

                    // Delete the user's profile from the database
                    $deleteQuery = "DELETE FROM users WHERE id='$userId'";
                    $deleteResult = mysqli_query($conn, $deleteQuery);

                    if ($deleteResult) {
                        // Profile deleted successfully
                        // Log out the user and redirect to the login page
                        session_unset();
                        session_destroy();
                        header("Location: login.php");
                        exit;
                    } else {
                        echo "Error deleting the user profile: " . mysqli_error($conn);
                    }
                }



            } else {
                echo "<p>No profile found.</p>";
            }
            

            // Close the database connection
            mysqli_close($conn);
            ?>

            
            
            <script>
                // Get the profile fields
                const displayNameField = document.getElementById('display-name');
                const usernameField = document.getElementById('username');
                const emailField = document.getElementById('email');

                // Get the edit profile button and save profile button
                const editProfileBtn = document.getElementById('edit-profile-btn');
                const saveProfileBtn = document.getElementById('save-profile-btn');

                // Get the change password and delete profile buttons
                const changePasswordBtn = document.getElementById('change-password-btn');
                const deleteProfileBtn = document.getElementById('delete-profile-btn');

                // Function to enable editing of profile fields
                function enableEditProfile() {
                    displayNameField.contentEditable = true;
                    usernameField.contentEditable = true;
                    emailField.contentEditable = true;

                    editProfileBtn.style.display = 'none';
                    saveProfileBtn.style.display = 'block';
                }

                // Function to save the changes made to the profile
                function saveProfileChanges() {
                    // Get the updated profile values
                    const updatedDisplayName = displayNameField.innerText;
                    const updatedUsername = usernameField.innerText;
                    const updatedEmail = emailField.innerText;

                    // Make an AJAX request to save the changes in the database
                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Changes saved successfully
                            alert("Profile changes saved successfully!");
                            location.reload();
                        }
                    };
                    xhr.open('POST', 'save_profile_changes.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send(`display_name=${updatedDisplayName}&username=${updatedUsername}&email=${updatedEmail}`);

                    // Disable editing of profile fields
                    displayNameField.contentEditable = false;
                    usernameField.contentEditable = false;
                    emailField.contentEditable = false;

                    editProfileBtn.style.display = 'block';
                    saveProfileBtn.style.display = 'none';

                }

                 // Function to redirect to the change password page
                function changePassword() {
                    window.location.href = 'change_password.php';
                }

                // Function to delete the user account
                function deleteProfile() {
                    if (confirm('Are you sure you want to delete your account?')) {
                        // Submit the form to delete_profile.php
                        document.getElementById('delete-profile-form').submit();
                    }
                }


                // Add click event listeners to the buttons
                editProfileBtn.addEventListener('click', enableEditProfile);
                saveProfileBtn.addEventListener('click', saveProfileChanges);
                changePasswordBtn.addEventListener('click', changePassword);
                deleteProfileBtn.addEventListener('click', deleteProfile);
            </script>
        </div>

        <div class="recipe-container">
            <?php
            // Retrieve the user's uploaded recipes
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

            // Retrieve the user's uploaded recipes
            $query = "SELECT * FROM recipes WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            // Check if any recipes were found
            if (mysqli_num_rows($result) > 0) {
                // Display the user's uploaded recipes
                echo '<div id="recipe-containers">';

                echo '<div class="recipe-actions">';
                echo '<h3>Your Recipes</h3>';
                echo '<a class="new-recipe" href="upload_recipe.php"><button class="new-recipe-btn">+ New Recipe</button></a>';
                echo '</div>';

                echo '<ul>';

                while ($row = mysqli_fetch_assoc($result)) {
                    $recipeId = $row['id'];
                    $recipeName = $row['recipe_name'];
                    $recipeImage = $row['image'];

                    // If the recipe image exists, update the image path
                    if ($recipeImage) {
                        $recipeImagePath = "" . $recipeImage;
                    } else {
                        // If no image is available, you can use a placeholder image or display a default image
                        $recipeImagePath = "path/to/placeholder/image.png"; // Replace with the path to your placeholder image
                    }

                    // Display the recipe image and name
                    
                    echo "<li>";
                    echo "<img src='$recipeImagePath' alt='Recipe Image' class='recipe-image'>";
                    echo "<div class='rec-name'>";
                    echo $recipeName;
                    echo "</div>";
                    echo "<a href='view_recipe.php?id=$recipeId' ><button class='view-btn'>View Recipe</button></a>";
                    echo "</li>";
                    
                }

                    echo '</ul>';
                echo '</div>';
            } else {
                echo "<p>No recipes found.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
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
