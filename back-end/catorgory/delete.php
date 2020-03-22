<?php
if(empty($_REQUEST['csrftoken'])){
    header("Location: ../../admin/catorgory.php?error=* Unexpected Error");
    exit;
}
else{
$servername = "localhost";
$username = "root";
$password = "1234";


$dbname = 'shop';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$deletecommand="delete from catorgory where cid=:cid";
$pdoStatement=$conn->prepare($deletecommand);
$pdoStatement->bindParam(':cid',$_REQUEST["cid"]);
$pdoStatement->execute();

header("Location: ../../admin/catergory.php");
}
?>