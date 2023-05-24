<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Cookpedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
<header>
    <div id="header">
    <nav id="hnav">
    <a href="header.php"><img class="imgHeader" src="CookpediaLogo.png" alt="Cookpedia Logo"></a>
                <ul id="h-ul">
                <li><a href="header.php">Home</a></li>
				<li><a href="--" id="h-about-us">About Us</a></li>
                <li><a class="active" href="signup.php" id="h-getStarted">Get Started</a></li>
			</ul> 
               
        </nav>
    </div> 
</header>

<div class="sign-up-container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h2>Sign Up</h2>
            <p class="join">Join Cookpedia now!</p>
            <p class="already"> Already have an account? <a href="login.php" class="login-here">Login here</a></p>
            <form class="signup-form" action="signup_process.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Email address"id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password"id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password"id="confirm_password" name="confirm_password" required>
                </div>
                <p id="eula">By creating an account, you agree to our Terms & Conditions and Privacy Policy.<p>
                <button type="submit" class="button-create">Create Account</button>
                
            </form>
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
