<?php
  if(!isset($_COOKIE['login'])){
    header("Location: ./login.php");
    exit;
}
    session_start();
    $userinfo = htmlspecialchars($_SESSION["user"]);
?>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../stylesheets/adminpage.css">
        <title>Admin Panel</title>
    </head>

    <body >
        <div class="wrapper">
            <div class="header" id="header"> 
                <div class="headermenubutton"  onclick="toggleNav()">
                    <i class="glyphicon glyphicon-th-list" ></i>
                </div>

                <div class="headertitletext">
                    Admin Panel
                </div>

                <div class="headerusertext">
                    <?php echo"Hi! {$userinfo}" ?>
                </div>
            </div>
        

            <div class="mainpage">
                    <div class="sidebar" id="sidebar">             
                        
                            <div>
                                    <a href= "./admin.php"  style="text-decoration:none;"  class="menuitem" ><i class="fas fa-home"></i>&emsp;Home</a>
                                    <a href= "./resetpw.php"  style="text-decoration:none;"  class="menuitem" ><i class="fas fa-cog"></i>&emsp;Setting</a>
                                    <a href= "./catergory.php"  style="text-decoration:none;"  class="menuitem" ><i class="fas fa-sitemap"></i>&emsp;Catorgory</a>
                                    <a href= "./manageproduct.php"  style="text-decoration:none;"  class="menuitem" ><i class="fab fa-product-hunt"></i>&emsp;Product Management</a>
                                    <a href= "./addproduct.php"  style="text-decoration:none;"  class="menuitem" ><i class="fas fa-box"></i>New Product</a>
                            </div>
                            <div>
                                <a class="menuitem" style="text-decoration:none;" href="../back-end/account/adminlogout.php" >
                                    <i class="fas fa-sign-out-alt"></i>&emsp;Logout
                                </a>  
                            </div>                
                    </div>

                   
                    

                    <div class="adminarea">
                        <span class='welcometext'>Reset Password</span>
                        <?php
                            if(isset($_GET['error'])){
                                echo "<div class='errorarea'>{$_GET['error']}</div>";
                            }
                        ?>
                        <form class="resetpwarea" action="../back-end/account/adminresetpw.php" method="POST">
                            <?php
                                echo"<input type='hidden' name='username' value={$userinfo} >";
                                echo"<input type='hidden' name='csrftoken' value={$_COOKIE['login']}>";
                            ?>
                            <div class="resetpwitem">
                                <span class="resetpwtext">Enter your original password:</span>
                                <input type="password" name="oldpassword" class="resetpwfield" placeholder="Password">
                            </div>
                            <div class="resetpwitem">
                                <span class="resetpwtext">Enter your new password:</span>
                                <input type="password" name="newpassword" class="resetpwfield" placeholder="Password">
                            </div>
                            <div class="resetpwitem">
                                <span class="resetpwtext">Enter your new password again:</span>
                                <input type="password" name="newpassword2" class="resetpwfield" placeholder="Password">
                            </div>
                            
                            <input type="submit" value="Reset" class="resetbutton">
                            
                        </form>
                    </div>
                   
                        
            </div>
        </div>
    </body>
    <script src="../javascripts/main.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>