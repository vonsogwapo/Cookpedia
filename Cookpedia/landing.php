<!DOCTYPE html>
<html>
<head>
    <title>Landing - Cookpedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
<header>
<div id="header">
        <nav id="hnav">
        <a href="Landing Page.html"><img class="imgHeader" src="CookpediaLogo.png"/></a>
        <form class="h-search">
            <img class="MagnifGlass" src="magnifGlass.png"/>   
            <input type="text" id="search-bar" placeholder="Search Recipes">
            <button type="search">Search</button>
        </form>
            <ul id="h-ul">
				<li><a class="active" href="Landing Page.html" id="h-home">Home</a></li>
				<li><a href="--" id="h-about-us">About Us</a></li>
				<li><a href="--" id="h-contact-us">Contact Us</a></li>
                <li><a href="login.php" id="h-login">Login</a></li>
                <li><a href="--" id="h-getStarted">Get Started</a></li>
			</ul> 
                 
        </nav>
    </div> 
</header>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h2>Welcome to Cookpedia</h2>
            <p>Here are some popular and recommended recipes:</p>
            <!-- Display popular and recommended recipes here -->
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
                        <li><a href="--" id="f-privacy">Privacy Policy</a></li>
                        <li><a href="--" id="f-terms">Terms of Service</a></li>
                    </ul>
                </div>

                <div id="f-services">
                        <p id="f-service">Services</p>
                    <ul id="f-rec">
                        <li><a href="--" id="f-recipe">Recipe</a></li>
                        <li><a href="--" id="f-course">Course</a></li>
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
