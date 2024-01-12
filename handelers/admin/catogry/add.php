<?php 
session_start();

require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";



if(isset($_POST['submit'])){

    $name=$_POST['name'];


    $errors['name']=vildatename($name);

    if(checkerrors($errors)){
        $add_catogry=$database->prepare("INSERT INTO catogry (catogry_name) VALUES(:name)");

        $add_catogry->bindParam("name",$name);

        if($add_catogry->execute()){

            $_SESSION['message']="catogry add successfully";

            header("location:../../../view/admin/add_catogry.php");
        }
    }else{
        $_SESSION['errors']=$errors;
        header("location:../../../view/admin/add_catogry.php");
    }
}