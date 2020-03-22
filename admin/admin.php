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
                        <span class="welcometext">Welcome to Admin Page</span>
                    </div>
                   
                        
            </div>
        </div>
    </body>
    <script src="../javascripts/main.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>