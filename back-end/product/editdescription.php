<?php
if(empty($_REQUEST['description'])) {
    header("Location: ../../admin/manageproduct.php?error=* The fields must be filled");
    exit;
}

else{
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = 'shop';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $editcommand="update product set description=:description where pid=:pid";
    $pdoStatement=$conn->prepare($editcommand);
    $description= filter_var($_REQUEST['description'], FILTER_SANITIZE_ENCODED);
    $pdoStatement->bindParam(':description',$description);
    $pdoStatement->bindParam(':pid',$_REQUEST["pid"]);
    $pdoStatement->execute();
    header("Location: ../../admin/manageproduct.php?success=* The desciption is updated");
}
?>