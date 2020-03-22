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
$getproductcommand="select * from product where pid=:pid";
$userinfo = htmlspecialchars($_SESSION["user"]);
echo"
<html>
    <head>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' type='text/css' href='./stylesheets/mainpage.css'>
        <title>Keung's Shop</title>
    </head>

    <body onload='productupdateui({$_GET['pid']})'>

      <div class='wrapper'>
            <div class='header' id='header'>
                  <div class='headermenubutton'  onclick='toggleNav()'>
                    <i class='glyphicon glyphicon-th-list' ></i>
                  </div>
                  <div class='headertitletext'>
                    Keung's Shop
                  </div>
                  <div class='headerusertext'>
                    Hi! {$userinfo}!
                  </div>
            </div>  ";
            
echo"
            <div class='mainpage'>
                    <div class='sidebar' id='sidebar'>             
                            <div>
                                <a href= './index.php'  style='text-decoration:none;'  class='menuitem' ><i class='fas fa-home'></i>&emsp;Home</a>
                                <a href= './resetpw.php'  style='text-decoration:none;'  class='menuitem' ><i class='fas fa-cog'></i>&emsp;Setting</a>";
                                  $readcommand='select * from catorgory';
                                  $stmt = $conn->prepare($readcommand);
                                  $stmt->execute();
                                  $result = $stmt->fetchAll();;
                                  foreach($result as $row){
                                    $cid=urlencode($row["cid"]);
                                    $name=htmlspecialchars($row["name"]);
                                    echo"<a href= './index.php?cid={$cid}'  style='text-decoration:none;' class='menuitem' ><i class='fab fa-product-hunt'></i>&emsp;{$name}</a>";
                                  }
 echo"                               
                            </div>
                            <div>
                                <a class='menuitem' style='text-decoration:none;' href='./back-end/account/logout.php'>
                                  <i class='fas fa-sign-out-alt'></i>&emsp;Logout
                                </a>  
                            </div>                
                    </div>

                    <div class='maincontent' id='maincontent'>

                        <div class='shoppinglistarea'>
                            <div class='shoppinglistdetail'><i class='fas fa-shopping-cart'></i>&emsp;My Shopping List
                                <div class='shoppingpopup' id='shoppingpopup'>
                                </div>
                            </div>
                            <div><i class='far fa-money-bill-alt'></i>&emsp;Checkout</div>
                        </div>";
                        
                        $stmt = $conn->prepare($getproductcommand);
                        $stmt->bindParam(':pid',$_GET['pid']);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row){
                          $name=htmlspecialchars($row["name"]);
                          $cid=$row["cid"]; 
                          $price=htmlspecialchars($row["price"]);
                          $pid=urlencode($row["pid"]); 
                          $description=htmlspecialchars($row["description"]);  
                          echo"<div class='productarea'>
                              <div class='productdirectory'>
                              <a href= './index.php'>Home</a>
                              <span>/</span>";
                          $getcidnamecommand="select * from catorgory where cid={$cid}";
                          $stmt2 = $conn->prepare($getcidnamecommand);
                          $stmt2->execute();
                          $result2 = $stmt2->fetchAll();
                          foreach($result2 as $row2){
                            $name2=$row2["name"];
                            echo "<a href= './index.php?cid={$cid}'>{$name2}</a>";
                          }
                          echo"<span>/</span>".
                            "<a href= './product.php?pid={$pid}'>{$name}</a>".
                            "</div>".
                            "<div class='producttop'>".
                            "<div class='producttopleft'>".
                            "<img src='./public/images/{$name}.png' class='producttopleftimage'/>".
                            "<a href='#imgfull' class='imageenlarge'><i class='fas fa-search-plus'></i></a>".
                            "<div class='fullimage' id='imgfull'>".
                            "<img src='./public/images/{$name}.png'/>".
                            "<a class='fullimageclose' href='#'></a>".
                            "</div></div>".
                            "<div class='producttopright'>".
                            "<span class='producttoprighttitle'>{$name}</span>".
                            "<span class='producttoprightprice'>$ {$price}</span>".
                            "<div class='numberrow'>".
                            "<button class='addnumber' onclick='productadd(`{$pid}number`,{$pid})'>+</button>".
                            "<input type='text' class='enternumber' id='{$pid}number' value=0 onchange='productchange(`{$pid}number`,{$pid})'/>".
                            "<button class='minusnumber' onclick='productminus(`{$pid}number`,{$pid})' >-</button>".
                            "</div></div></div>".                       
                            "<div class='productbottom'>".
                            "<span class='productbottomtitle'>Product Specification</span>".
                            "<table class='spectable'>".
                            "<tr class='spectablerow'>
                            <td class='spectableheader'>Description</td>
                            <td class='spectablecontent'>{$description}</td>
                            </tr>".
                            
                            "</table></div></div>";   
                        }
  echo"                      
                    </div>
                        
                 </div>
              </div>
        </body>
        <script src='./javascripts/main.js'></script>
        <script src='https://kit.fontawesome.com/53121c113e.js'></script>
    </html>"
?>