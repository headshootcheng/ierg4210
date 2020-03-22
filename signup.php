<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./stylesheets/loginpage.css">
        <title>Sign Up</title>
    </head>
    <body class="signupwrapper">
        <div class="signuparea">
            <span class='signuptitle'>Sign Up</span>
            <?php 
            if(isset($_GET['error'])){
                echo "<div class='errorarea'>{$_GET['error']}</div>";
            }
            ?>
            <form style="align-items: center;justify-content: center;display:flex;flex-direction:column" action="./back-end/account/signup.php" method="post">
                <div class='signuprow'>
                    <span class='signuptext'>Username:</span>
                    <input type="text" name="username" id="username" class="loginfield" placeholder="Enter your username" pattern="[A-z0-9]{1,15}">
                </div>
                <div class='signuprow'>
                    <span class='signuptext'>Email:</span>
                    <input type="email" name="email"  id="email" class="loginfield" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}">
                </div>
                <div class='signuprow'>
                    <span class='signuptext'>Password:</span>
                    <input type="password" name="password" id="password" class="loginfield" placeholder="Enter your password" pattern="[A-z0-9]{1,15}">
                </div>    
                <div class='signuprow'>
                    <span class='signuptext'>Confirmed Password:</span>
                    <input type="password" name="password2" id="password2" class="loginfield" placeholder="Enter your password again" pattern="[A-z0-9]{1,15}">
                </div>   
                <input type="submit" value="Sign Up" class="loginbutton">
                <a class='signupbutton' href="./login.php">
                    Back
                </a>
            </form>
        </div>  
    </body>
    <script src="./javascripts/login.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>