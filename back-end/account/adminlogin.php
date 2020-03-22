<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $exist=0;
    $dbname = 'shop';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $readcommand="select * from account";
    $match=0;
    $stmt = $conn->prepare($readcommand);
    $stmt->execute();
    $inputusername=filter_var($_REQUEST['username'], FILTER_SANITIZE_ENCODED);
    $inputpassword=filter_var($_REQUEST['password'], FILTER_SANITIZE_ENCODED);
    $result = $stmt->fetchAll();
    foreach($result as $row){
        if($inputusername==$row["username"]&&$inputpassword==$row["password"]&&$row["isadmin"]==1){
            $match=$match+1;
        }
    }
    if($match==0){
        header("Location: ../../admin/login.php?error=* Wrong username or password");
        exit;
    }
    else{
        session_start();
        $_SESSION["user"]= $inputusername;
        $hashusername= password_hash($inputpassword,PASSWORD_DEFAULT,['cost' => 11]);
        $cookieexpiry = time() +60*60*24*3;
        setcookie("login",$hashusername,$cookieexpiry,'/','',0,TRUE);
        header("Location: ../../admin/admin.php");
        exit;
    }
?>