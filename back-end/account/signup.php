<?php
$inputusername=filter_var($_REQUEST['username'], FILTER_SANITIZE_ENCODED);
$inputemail = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
$inputpassword=filter_var($_REQUEST['password'], FILTER_SANITIZE_ENCODED);
$inputpassword2=filter_var($_REQUEST['password2'], FILTER_SANITIZE_ENCODED);
 if(empty($inputusername)||empty($inputemail)||empty($inputpassword)||empty($inputpassword2)){
    header("Location: ../../signup.php?error=* All fields must be filled");
    exit;
 }
 else{
     if($inputpassword!=$inputpassword2){
        header("Location: ../../signup.php?error=* Password does not matched");
        exit;
     }
     else{
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $exist=0;
        $dbname = 'shop';
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        $readcommand="select * from account";
        $stmt = $conn->prepare($readcommand);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        foreach($result as $row){
            if($inputusername==$row["username"]||$inputemail==$row['email']){
                $exist=$exist+1;
            }
        }
        if($exist==0){
            $hash=password_hash($inputpassword,PASSWORD_DEFAULT,['cost' => 11]);
            $insertcommand="insert into account (username,email,password,isadmin) values (:username,:email,:hash,0)";
            $pdoStatement=$conn->prepare($insertcommand);
            $pdoStatement->bindParam(':username',$inputusername);
            $pdoStatement->bindParam(':email',$inputemail);
            $pdoStatement->bindParam(':hash',$hash);
            $pdoStatement->execute();
           
            header("Location: ../../login.php?success=* You are registered successfully");
            exit;
        }
        else{
            header("Location: ../../signup.php?error=* Username or Email is already existed");
            exit;
        }
     }
 }
?>