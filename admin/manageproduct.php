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
$selectcommand='select * from product';
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
                    <?php echo"Hi! {$_SESSION['user']}" ?>
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
                        <span class="welcometext">Product List</span>
                        <?php 
                        if(isset($_GET['error'])){
                            echo "<div class='errorarea'>{$_GET['error']}</div>";
                        }
                        if(isset($_GET['success'])){
                            echo "<div class='successarea'>{$_GET['success']}</div>";
                        }
                        ?>
                        <table class="datatable">
                            <tr class="datarow">
                                <th class="dataitem">Id</th>
                                <th class="dataitem">Name</th>
                                <th class="dataitem">Price</th>
                                <th class="dataitem">Cid</th>
                                <th class="dataitem">Image</th>
                                <th class="dataitem">Description</th>
                                <th class="dataitem">Delete</th>
                            </tr>
                            <?php
                            $stmt = $conn->prepare($selectcommand);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $row){
                                $name=htmlspecialchars($row['name']);
                                $pid=htmlspecialchars($row['pid']);
                                $price=htmlspecialchars($row['price']);
                                $description=htmlspecialchars($row['description']);
                                $cid= htmlspecialchars($row['cid']);
                                echo"<tr class='datarow'>".
                                    "<form action='../back-end/product/delete.php' method='post'>".
                                    "<td class='dataitem' name='pid'><input type='hidden' name='csrftoken' value='{$_COOKIE["login"]}'/><input name='pid' type='hidden' value='{$pid}'>{$pid}</input></td>".
                                        "<td class='dataitem' id='name{$pid}'><input name='name' type='hidden' value='{$name}' id='nameinput{$pid}'>{$name}</input>&emsp;<button class='submitbutton' onclick='editproductname({$pid})'><i class='fas fa-edit'></i></button></td>".
                                        "<td class='dataitem' id='price{$pid}'><input name='price' type='hidden' value='{$price}' id='priceinput{$pid}'>{$price}</input>&emsp;<button class='submitbutton' onclick='editproductprice({$pid})'><i class='fas fa-edit'></i></button></td>".
                                        "<td class='dataitem' id='cid{$pid}'>{$cid}</td>".
                                        "<td class='dataitem' id='image{$pid}'><img src='../public/images/{$name}.png' height='60' width='60'/>&emsp;<button class='submitbutton' onclick='editproductimage({$pid})'><i class='fas fa-edit'></i></button></td>".
                                        "<td class='dataitem' id='description{$pid}'><input name='description' type='hidden' value='{$description}' id='descriptioninput{$pid}'>{$description}</input>&emsp;<button class='submitbutton' onclick='editproductdescription({$pid})'><i class='fas fa-edit'></i></button></td>".
                                        "<td class='dataitem' id='option{$pid}'><button class='submitbutton' type='submit' ><i class='fas fa-trash'></i></button></td>".
                                        "</form>".
                                        "</tr>";
                            }
                            ?>
                        </table>

                        

                        
                    </div>
                    
                        
            </div>
        </div>
    </body>
    <script src="../javascripts/main.js"></script>
    <script src="../javascripts/admin.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>