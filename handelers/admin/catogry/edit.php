<?php 
session_start();

require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";


// var_dump($_POST);
// die;
if(isset($_POST['update'])){

    $catogry_id=$_POST['id'];
    $name=$_POST['name'];


    $errors['name']=vildatename($name);

    if(checkerrors($errors)){
        $updatecatogry=$database->prepare("UPDATE  catogry SET  catogry_name=:name where id =:catogry_id");

        $updatecatogry->bindParam("name",$name);
        $updatecatogry->bindParam("catogry_id",$catogry_id);

        if($updatecatogry->execute()){
            // var_dump($updatecatogry->execute());
            // die;

            $_SESSION['message']="catogry update successfully";

            header("location:../../../view/admin/all_catogries.php");
        }
    }else{
        $_SESSION['errors']=$errors;
        header("location:../../../view/admin/edit_catogry.php");
    }
}