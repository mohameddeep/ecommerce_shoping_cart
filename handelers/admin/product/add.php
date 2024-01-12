<?php 
session_start();

require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";



if(isset($_POST['submit'])){

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
        

        $add_catogry=$database->prepare("INSERT INTO product (product_name,product_descr,price,catogry_id,product_image) 
        VALUES(:name,:descr,:price,:ct_id,:image)");

        $add_catogry->bindParam("name",$name);
        $add_catogry->bindParam("descr",$description);
        $add_catogry->bindParam("price",$price);
        $add_catogry->bindParam("ct_id",$catogry_id);
        $add_catogry->bindParam("image",$newimg);

        if($add_catogry->execute()){

            $_SESSION['message']="product add successfully";

            header("location:../../../view/admin/add_product.php");
        }
    }else{
        $_SESSION['errors']=$errors;
        header("location:../../../view/admin/add_product.php");
    }
}