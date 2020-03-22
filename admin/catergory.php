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
                        <span class="welcometext">Catorgory</span>
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
                                <th class="dataitem">Options</th>
                            </tr>
                            <?php
                            $stmt = $conn->prepare($selectcommand);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $row){
                                $name=htmlspecialchars($row['name']);
                                $cid=htmlspecialchars($row['cid']);
                                echo"<tr class='datarow'>".
                                    "<form action='../back-end/catorgory/delete.php' method='post'>".
                                    "<td class='dataitem' name='cid'><input type='hidden' name='csrftoken' value={$_COOKIE['login']}><input name='cid' type='hidden' value='{$cid}'>{$cid}</input></td>".
                                    "<td class='dataitem' id='name{$cid}'>{$name}</td>".
                                    "<td class='dataitem' id='option{$cid}'><button class='submitbutton' type='submit' ><i class='fas fa-trash'></i></button>&emsp;<button class='submitbutton' onclick='catergoryeditname({$cid})'><i class='fas fa-edit' ></i></button></td>".
                                    "</form>".
                                    "</tr>";
                            }
                            ?>
                            <tr class="datarow">
                                <form action='../back-end/catorgory/insert.php'>
                                    <td class="dataitem">New</td>
                                    <?php
                                        echo"<input type='hidden' name='csrftoken' value={$_COOKIE['login']}>";
                                    ?>
                                    <td class="dataitem">Name: <input type='text' name='name' placeholder='Enter new name'/></td>
                                    <td class="dataitem"><button class='submitbutton' type='submit' ><i class='fas fa-plus-circle'></i></button></td>
                                </form> 
                            </tr>
                        </table>

                        

                        
                    </div>
                    
                        
            </div>
        </div>
    </body>
    <script src="../javascripts/main.js"></script>
    <script src="../javascripts/admin.js"></script>
    <script src="https://kit.fontawesome.com/53121c113e.js"></script>
</html>