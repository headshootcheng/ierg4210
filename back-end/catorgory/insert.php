<?php

if(empty($_REQUEST['name'])) {
    header("Location: ../../admin/catergory.php?error=* The fields must be filled");
    exit;
}
if(empty($_REQUEST['csrftoken'])){
    header("Location: ../../admin/catorgory.php?error=* Unexpected Error");
    exit;
}
else{
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = 'shop';
    $name= filter_var($_REQUEST['name'], FILTER_SANITIZE_ENCODED);
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $insertcommand="insert into catorgory (name) values (:name)";
    $pdoStatement=$conn->prepare($insertcommand);
    $pdoStatement->bindParam(':name',$name);
    $pdoStatement->execute();
    header("Location: ../../admin/catergory.php?success=* The data is inserted");
}
?>