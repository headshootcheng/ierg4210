<?php
    if(!isset($_COOKIE['login'])){
        header("Location: ./login.php");
        exit;
    }
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = 'shop';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $readcommand="select * from catorgory";
    $userinfo = htmlspecialchars($_SESSION["user"]);
?>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./stylesheets/mainpage.css">
        <title>Keung's Shop</title>
    </head>

    <body onload='indexupdateui()'> 
        <div class="wrapper">
             <div class="header" id="header">
                 
                        <div class="headermenubutton"  onclick="toggleNav()">
                         <i class="glyphicon glyphicon-th-list" ></i>
                       </div>
                       <div class="headertitletext">
                         Keung's Shop
                       </div>
                       <div class="headerusertext">
                         Hi! <?php echo htmlspecialchars($userinfo)?>!
                       </div>
              </div>
                  
            
 
             <div class="mainpage" >

                     <div class="sidebar" id="sidebar">             
                            
                             <div>
                                 <a href= "./index.php"  style="text-decoration:none;"  class="menuitem" ><i class="fas fa-home"></i>&emsp;Home</a>
                                 <a href= "./resetpw.php"  style="text-decoration:none;"  class="menuitem" ><i class="fas fa-cog"></i>&emsp;Setting</a>
                                 <?php
                                  $stmt = $conn->prepare($readcommand);
                                  $stmt->execute();
                                  $result = $stmt->fetchAll();;
                                  foreach($result as $row){
                                    $cid=urlencode($row["cid"]);
                                    $name=htmlspecialchars($row["name"]);
                                    echo"<a href= './index.php?cid={$cid}'  style='text-decoration:none;' class='menuitem' ><i class='fab fa-product-hunt'></i>&emsp;{$name}</a>";
                                  }       
                                 ?>   
                             </div>
                             <div>
                                 <a class="menuitem" style="text-decoration:none;" href="./back-end/account/logout.php">
                                   <i class="fas fa-sign-out-alt"></i>&emsp;Logout
                                 </a>  
                             </div>                
                     </div>
 
                     <div class="maincontent" id="maincontent">
                         <div class="shoppinglistarea">
                             <div class="shoppinglistdetail" id="shoppinglistdetail"><i class="fas fa-shopping-cart"></i>&emsp;My Shopping List
                                 <div class="shoppingpopup" id="shoppingpopup">
                                   
                                 </div>
                             </div>
                             <div><i class="far fa-money-bill-alt"></i>&emsp;Checkout</div>
                         </div>
                        
                         <div class="homearea">
                            <span class='welcometext'>Reset Password</span>
                            <?php
                                if(isset($_GET['error'])){
                                echo "<div class='errorarea'>{$_GET['error']}</div>";
                                }
                            ?>
                            <form class="resetpwarea" method="POST" action="./back-end/account/resetpw.php">
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
         
        </div>
     </body>
    <script src="./javascripts/main.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>