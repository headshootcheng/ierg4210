<?php
if(empty($_REQUEST['price'])) {
    header("Location: ../../admin/manageproduct.php?error=* The fields must be filled");
    exit;
}

else{
    $servername = "localhost";
    $username = "root";
    $password = "1234";

    $dbname = 'shop';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $editcommand="update product set price=:price where pid=:pid";
    $pdoStatement=$conn->prepare($editcommand);
    $price= filter_var($_REQUEST['price'], FILTER_SANITIZE_ENCODED);
    $pdoStatement->bindParam(':price',$price);
    $pdoStatement->bindParam(':pid',$_REQUEST["pid"]);
    $pdoStatement->execute();

    
    header("Location: ../../admin/manageproduct.php?success=* The price is updated");
 
}
?>