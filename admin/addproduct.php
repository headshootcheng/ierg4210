<?php
if(!isset($_COOKIE['login'])){
    header("Location: ./login.php");
    exit;
}
$servername = "localhost";
$username = "root";
$password = "1234";
session_start();
$dbname = 'shop';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$selectcommand='select * from catorgory';
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
                        <span class="welcometext">New Product</span>
                        <?php 
                        if(isset($_GET['error'])){
                            echo "<div class='errorarea'>{$_GET['error']}</div>";
                        }
                        if(isset($_GET['success'])){
                            echo "<div class='successarea'>{$_GET['success']}</div>";
                        }
                        ?>
                        <form action='../back-end/product/insert.php' method="post" enctype="multipart/form-data">
                            <?php
                                 echo"<input type='hidden' name='csrftoken' value={$_COOKIE['login']}>";
                            ?>
                            <div style="flex-direction:row;display:flex;">
                                Product name:<br/>
                                <input type="text" name="name" placeholder="Product name"/>
                            </div>
                            <br/>
                            <div style="flex-direction:row;display:flex;">
                                Product price:
                                <input type="number" min="0" name="price" oninput="validity.valid||(value='');" placeholder="Product price"/>
                            </div>
                            <br/>
                            Product Description:<br/>
                            <textarea cols="80" rows="5" name="description"></textarea>
                            <br/>
                            <br/>
                            <div style="flex-direction:row;display:flex;">
                                Product catorgory:
                                <select name="catorgory">
                                <?php
                                    $stmt = $conn->prepare($selectcommand);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row){
                                        $name=htmlspecialchars($row["name"]);
                                        $cid=htmlspecialchars($row["cid"]);
                                        echo "<option value={$cid}>{$name}</option>";
                                    }
                                ?>
                                </select>
                            </div> 
                            <br/>
                            <div style="flex-direction:row;display:flex;">
                                Product image:
                                <input type="file" name="image"/>
                            </div>
                            <br/>
                            <input type="submit" name="submit" value="Submit"/>
                        </form>                            
                    </div>

                </div>
                        
            
        </div>
    </body>
    <script src="../javascripts/main.js"></script>
    <script src="../javascripts/admin.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>