<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Perform necessary password validation checks
    // (e.g., minimum length, complexity requirements, etc.)

    // Check if the new password matches the confirm password
    if ($newPassword !== $confirmPassword) {
        $error = "New password and confirm password do not match.";
    } else {
        // Retrieve the user's current password from the database
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

        $userId = $_SESSION['user_id'];
        $query = "SELECT password FROM users WHERE id='$userId'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $currentPassword = $row['password'];

            // Verify if the old password matches the user's current password
            if ($oldPassword === $currentPassword) {
                // Update the user's password in the database
                $updateQuery = "UPDATE users SET password='$newPassword' WHERE id='$userId'";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    $success = "Password updated successfully!";
                        // Redirect to view_profile.php
                        header("Location: view_profile.php");
                        exit;
                } else {
                    $error = "Error updating password. Please try again.";
                }
            } else {
                $error = "Old password is incorrect.";
            }
        } else {
            $error = "User not found.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password - Cookpedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>


<body>
<header>
<div id="header">
        <nav id="hnav">
        <?php $isLoggedIn = true; ?>
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

    <div class="cp-container">
        <h3>Change Password</h3>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <form class="password-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Old Password" id="old-password" name="old_password">
            </div>
            <div class="mb-3">                
                <input type="password" class="form-control" placeholder="New Password" id="new-password" name="new_password">
            </div>
            <div class="mb-3">                
                <input type="password" class="form-control" placeholder="Confirm New Password" id="confirm-password" name="confirm_password">
            </div>
            <button type="submit" class="change-password-btn">Change Password</button>
            <button class="cancel-btn"><a href="view_profile.php" class="cancel-bt">Cancel</a></button>
        </form>
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
