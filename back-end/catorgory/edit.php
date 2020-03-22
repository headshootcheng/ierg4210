<?php


if(empty($_REQUEST['name'])) {
    header("Location: ../../admin/catergory.php?error=* The fields must be filled");
    exit;
}

else{
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $name= filter_var($_REQUEST['name'], FILTER_SANITIZE_ENCODED);
    $dbname = 'shop';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $editcommand="update catorgory set name=:name where cid=:cid";
    $pdoStatement=$conn->prepare($editcommand);
    $pdoStatement->bindParam(':name',$name);
    $pdoStatement->bindParam(':cid',$_REQUEST["cid"]);
    $pdoStatement->execute();

    header("Location: ../../admin/catergory.php?success=* The name is updated");
 
}
?>