<?php
    //echo $_REQUEST['name'];
    //echo $_REQUEST['oldname'];
    if(empty($_REQUEST['name'])) {
        header("Location: ../../admin/manageproduct.php?error=* The fields must be filled");
        exit;
    }
   
    else{
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = 'shop';
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $editcommand="update product set name=:name' where pid=:pid";
        $pdoStatement=$conn->prepare($editcommand);
        $pdoStatement->bindParam(':name',$_REQUEST["name"]);
        $pdoStatement->bindParam(':pid',$_REQUEST["pid"]);
        $pdoStatement->execute();

        $oldfilename="../../public/images/{$_REQUEST["oldname"]}.png";
        $name= filter_var($_REQUEST['name'], FILTER_SANITIZE_ENCODED);
        $newfilename="../../public/images/{$name}.png";
        rename($oldfilename,$newfilename);
        header("Location: ../../admin/manageproduct.php?success=* The name is updated");
       
    }
?>