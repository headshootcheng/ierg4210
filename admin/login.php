<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../stylesheets/adminpage.css">
        <title>Login</title>
    </head>
    <body class="loginwrapper">
        <div class="loginarea">
            <span class='logintitle'>Login</span>
            <?php 
            if(isset($_GET['error'])){
                echo "<div class='errorarea'>{$_GET['error']}</div>";
            }
            if(isset($_GET['success'])){
                echo "<div class='successarea'>{$_GET['success']}</div>";
            }
            ?>
            <form style="align-items: center;justify-content: center;display:flex;flex-direction:column" action="../back-end/account/adminlogin.php" method="POST">
                <div class='loginrow'>
                    <span class='logintext'>Username:</span>
                    <input type="text" name="username" class="loginfield">
                </div>
                <div class='loginrow'>
                    <span class='logintext'>Password:</span>
                    <input type="password" name="password" class="loginfield">
                </div>    
                <input type="submit" value="Login" class="loginbutton">
            </form>
        </div>
    </body>
</html>