<?php 
session_start();

require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";

if(isset($_POST['register'])){

    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $confirm_pass=md5($_POST['password_confirmation']);


    $errors['email']=vildatemail($email);
    $errors['password']=vildatepassword($password,$confirm_pass);

    if(checkerrors($errors)){

        $insertdata=$database->prepare("INSERT INTO users(email,password) VALUES(:email,:password)");
        $insertdata->bindParam(":email",$email);
        $insertdata->bindParam(":password",$password);
        $insertdata->execute();
        // var_dump($insertdata);
        // die();

        header("location:../../../view/user/login.php");

        

    }else{
       $_SESSION['errors']=$errors;
    //    var_dump($errors);
    //    die;
       header("location:../../../view/user/login.php");
    }
}