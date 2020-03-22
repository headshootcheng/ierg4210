<?php
    $target_dir="../../public/images/";
    if ( $_FILES["image"]["size"] > 10000000) {
        header("Location: ../../admin/manageproduct.php?error=* The file size is too big(limited to 10Mb");
        exit;
    }
   
    else{
        if($_FILES['image']['type']=="image/jpeg"||$_FILES['image']['type']=="image/png"||$_FILES['image']['type']=="image/gif"){
            $filename="../../public/images/{$_REQUEST["name"]}.png";
            unlink($filename);
            $target_file = $target_dir .basename("{$_REQUEST["name"]}.png") ;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            header("Location: ../../admin/manageproduct.php?success=* The image is updated");
        }
        else{
            header("Location: ../../admin/manageproduct.php?error=* The file type must in jpeg/gif/png format");
            exit;
        }
    }
?>