<?php
if(empty($_REQUEST['csrftoken'])){
    header("Location: ../../admin/manageproduct.php?error=* Unexpected Error");
    exit;
}
else{
$servername = "localhost";
$username = "root";
$password = "1234";
$conn = new mysqli($servername, $username, $password);
$dbname = 'shop';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$deletecommand="delete from product where pid= :pid";
$pdoStatement=$conn->prepare($deletecommand);
$pdoStatement->bindParam(':pid',$_REQUEST["pid"]);
$pdoStatement->execute();
$filename="../../public/images/{$_REQUEST["name"]}.png";
//echo $filename;
unlink($filename);
header("Location: ../../admin/manageproduct.php");
}
?>