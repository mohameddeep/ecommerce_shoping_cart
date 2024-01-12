<?php 
session_start();

require "../../core/dbconnect.php";
require "../../core/validation.php";
require "../../core/functions.php";

// var_dump($_GET);


if(isset($_GET['login'])){
    $email=$_GET['email'];
    $password=md5($_GET['password']);

    $errors['email']=vildatemail($email);
    $errors['password']=vildateloginpassword($_GET['password']);

    // var_dump($errors);
    // die();



    if(checkerrors($errors) == true){

        

        $checklogin=$database->prepare("SELECT * FROM admin WHERE email =:email AND password =:password");
        $checklogin->bindParam("email",$email);
        $checklogin->bindParam("password",$password);

        $checklogin->execute();

        if($checklogin->rowCount() == 1){
            $row=$checklogin->fetchObject();

            $_SESSION['admin']=$row;
            $_SESSION['login']=true;
            header("location:../../view/admin/index.php");

        }else{
            header("location:../../view/admin/admin_login.php");
        }


    }else{

        $_SESSION['errors']=$errors;
        header("location:../../view/admin/admin_login.php");

    }


    
}else{
    header("location:../../view/admin/admin_login.php");
}
