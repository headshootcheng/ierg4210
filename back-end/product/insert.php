<?php


if(empty($_REQUEST['name'])||empty($_REQUEST['price'])) {
    header("Location: ../../admin/addproduct.php?error=* The fields must be filled");
    exit;
}
if(empty($_REQUEST['csrftoken'])){
    header("Location: ../../admin/manageproduct.php?error=* Unexpected Error");
    exit;
}
else{
    $target_dir="../../public/images/";
    if ( $_FILES["image"]["size"] > 10000000) {
        header("Location: ../../admin/addproduct.php?error=* The file size is too big(limited to 10Mb");
        exit;
    }
    else{
            
        if($_FILES['image']['type']=="image/jpeg"||$_FILES['image']['type']=="image/png"||$_FILES['image']['type']=="image/gif"){
            $target_file = $target_dir .basename("{$_REQUEST["name"]}.png") ;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            $servername = "localhost";
            $username = "root";
            $password = "1234";
            $dbname = 'shop';
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);;
            $insertcommand="insert into product (name,price,cid,description) values (:name,:price,:cid,:description)";
            $pdoStatement=$conn->prepare($insertcommand);
            $name= filter_var($_REQUEST['name'], FILTER_SANITIZE_ENCODED);
            $price= filter_var($_REQUEST['price'], FILTER_SANITIZE_ENCODED);
            $description= filter_var($_REQUEST['description'], FILTER_SANITIZE_ENCODED);
            $pdoStatement->bindParam(':name',$name);
            $pdoStatement->bindParam(':price',$price);
            $pdoStatement->bindParam(':cid',$_REQUEST["catorgory"]);
            $pdoStatement->bindParam(':description',$description);
            $pdoStatement->execute();
            header("Location: ../../admin/addproduct.php?success=* The data is inserted");
        }
        else{
            header("Location: ../../admin/addproduct.php?error=* The file type must in jpeg/gif/png format");
            exit;
        }
    }
}
?>