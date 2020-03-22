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
                                  $result = $stmt->fetchAll();
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

                         <?php
                          if(isset($_GET['cid'])){
                            $getproductcommand="select * from product where cid={$_GET['cid']}";
                            $stmt = $conn->prepare($getproductcommand);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            echo  "<div class='productlist'>";
                            foreach($result as $row){
                              $number=$number+1;  
                              $name=htmlspecialchars($row['name']);
                              $price=htmlspecialchars($row['price']);
                              $pid=urlencode($row['pid']);
                              echo "<div class='productdetail'>
                                    <div class='eachproductdetail'>
                                    <span class='producttitle'>{$name}</span>
                                    </div>
                                    <a class='eachproductdetail' href='./product.php?pid={$pid}'>
                                    <img src='./public/images/{$name}.png' class='productimage'/>
                                    </a>
                                    <div class='eachproductdetail'>
                                    <span class='productprice'>$ {$price}</span>
                                    </div>
                                    <div class='eachproductdetail' id='cart{$number}'>
                                    <button class='addtocart' onclick='addcart({$number},{$pid})'>Add</button>
                                    </div>
                                    </div>";
                            }       
                            echo "</div>";
                                
                          }
                          else{                        
                            echo "<div class='homearea'>
                                  <span class='welcometext'>Welcome to the Keung's Shop</span>
                                  <div style='flex-direction:row;display:flex;'>
                                    <span class='welcometext'>Catorgories: </span>
                                    <div class='catorgorylist'> ";
                            $stmt = $conn->prepare($readcommand);
                            $stmt->execute();
                            $result = $stmt->fetchAll();;
                            foreach($result as $row){
                              $cid=urlencode($row["cid"]);
                              $name=htmlspecialchars($row["name"]);
                              echo"<a href='./index.php?cid={$cid}' style='text-decoration:none;' class='eachcatorgory'>{$row["name"]}</a>";
                            }                                             
                             echo"</div></div></div>";                                         
                          }
                          ?>
                      </div>


                                       
             </div>
         
        </div>
     </body>
    <script src="./javascripts/main.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>