<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = 'shop';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pid=(int)$_POST["pid"];
$selectcommand="select* from product where pid={$pid}";
$stmt = $conn->prepare($selectcommand);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
    $name=$row["name"];
    $price=(int)$row["price"];
}
 class product{
    public $pid= "";
    public $name  = "";
    public $price = "";
 }
 $e =new product();
 $e->pid=$pid;
 $e->name=$name;
 $e->price=$price;

 echo json_encode($e);
 mysqli_close($conn);

?>