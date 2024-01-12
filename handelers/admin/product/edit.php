<?php 
session_start();

require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";



if(isset($_POST['update'])){

    $product_id=$_POST['id'];

    $name=$_POST['name'];
    $description=$_POST['descr'];
    $price=$_POST['price'];
    $catogry_id=$_POST['catogry_id'];

    $image=$_FILES['image'];

    $imagename=$image['name'];
    $imagetype=$image['type'];
    $image_tmp=$image['tmp_name'];
    $imagesize=$image['size'];


    $errors['name']=vildatename($name);
    $errors['price']=vildateprice($price);
    $errors['descr']=vildatename($description);
    $errors['image']=validateimage($image);

    if(checkerrors($errors)){

        $extension=pathinfo($imagename)['extension'];
        $newimg=uniqid() . "." . $extension;

        move_uploaded_file($image_tmp,"../../../inc/files/". $newimg);
        

        $updateproduct=$database->prepare("UPDATE  product SET 
        product_name=:name ,product_descr=:descr,price=:price,catogry_id=:ct_id,product_image=:image
    WHERE product.id = :pd_id");

        $updateproduct->bindParam("name",$name);
        $updateproduct->bindParam("descr",$description);
        $updateproduct->bindParam("price",$price);
        $updateproduct->bindParam("ct_id",$catogry_id);
        $updateproduct->bindParam("image",$newimg);
        $updateproduct->bindParam("pd_id",$product_id);

        if($updateproduct->execute()){

            $_SESSION['message']="product updated successfully";

            header("location:../../../view/admin/all_products.php");
        }
    }else{
        $_SESSION['errors']=$errors;
        header("location:../../../view/admin/edit_product.php");
    }
}else{
    header("location:../../../view/admin/edit_product.php");
}