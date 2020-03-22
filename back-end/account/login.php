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
    $result = $stmt->fetchAll();
    $inputusername= filter_var($_REQUEST['username'], FILTER_SANITIZE_ENCODED);
    $inputpassword= filter_var($_REQUEST['password'], FILTER_SANITIZE_ENCODED);
    foreach($result as $row){
        if($inputusername==$row["username"]&&password_verify($inputpassword,$row["password"])){
            $match=$match+1;
        }
    }
    if($match==0){
        header("Location: ../../login.php?error=* Wrong username or password");
        exit;
    }
    else{
        session_start();
        $_SESSION["user"]= $inputusername;
        $cookieexpiry = time() +60*60*24*3;
        $hashusername= password_hash($inputusername,PASSWORD_DEFAULT,['cost' => 11]);
        setcookie("login",$hashusername,$cookieexpiry,'/','',0,TRUE);
        header("Location: ../../index.php");
    }
?>