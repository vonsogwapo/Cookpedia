

<!DOCTYPE html>
<html>
<head>
    <title>Login - Cookpedia</title>
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
            <h2>Login</h2>
            <p class="text-center mt-3">Don't have an account? <a href="signup.php" class="signup-here">Sign Up</a></p>

            <form class="signup-form" action="login_process.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                </div>
                <button type="submit" class="button-create" >Login</button>
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