<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $exist=0;
    $dbname = 'shop';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $inputusername=filter_var($_REQUEST['username'], FILTER_SANITIZE_ENCODED);
    $inputoldpassword=filter_var($_REQUEST['oldpassword'], FILTER_SANITIZE_ENCODED);
    $inputnewpassword=filter_var($_REQUEST['newpassword'], FILTER_SANITIZE_ENCODED);
    $inputnewpassword2=filter_var($_REQUEST['newpassword2'], FILTER_SANITIZE_ENCODED);
    if(empty($inputoldpassword)||empty($inputnewpassword)||empty($inputnewpassword2)){
        header("Location: ../../admin/resetpw.php?error=* Please fill in all the fields");
        exit;
    }
    if(empty($_REQUEST['csrftoken'])){
        header("Location: ../../admin/resetpw.php?error=* Unexpected Error");
        exit;
    }
    if($inputnewpassword!=$inputnewpassword2){
        header("Location: ../../admin/resetpw.php?error=* 2 fields must be the same");
        exit;
    }
    else{
        $selectcommand="select * from account WHERE username=:username";
        $stmt = $conn->prepare($selectcommand);
        $stmt->bindParam(':username',$inputusername);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            if($inputoldpassword!=$row['password']){
                header("Location: ../../admin/resetpw.php?error=* Wrong passoword");
                exit;
            }
        }
        $updatecommand="update account set password=:newpw where username=:username";
        $stmt2 = $conn->prepare($updatecommand);
        $stmt2->bindParam(':username',$inputusername);
        $stmt2->bindParam(':newpw',$inputnewpassword);
        $stmt2->execute();
        $cookieexpiry = time() -60*60*24*3;
        setcookie("login", '', $cookieexpiry, '/');
        session_start();
        $_SESSION = array();
        unset($_SESSION['user']);
        session_destroy();
        header("Location: ../../admin/login.php?success=* Your Password is successfully updated ");
        exit;
    }
?>