<?php 
session_start();
require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";



if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=md5($_POST['password']);


    $errors['email']=vildatemail($email);
    $errors['password']=vildateloginpassword($password);


    if(checkerrors($errors)){

        $loginuser=$database->prepare("SELECT * from users WHERE email=:emal AND password=:pass");
        $loginuser->bindParam("emal",$email);
        $loginuser->bindParam("pass",$password);

        $loginuser->execute();

        if($loginuser->rowCount() == 1){
            $user=$loginuser->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['user']=$user;
            $_SESSION['login']=true;
            // var_dump( $_SESSION);
            // die;

            header("location:../../../view/user/checkout.php");
        }else{
            $_SESSION['inncorect_user']="incorrect data entered";
            header("location:../../../view/user/login.php");
        }

    }else{
        
        $_SESSION['errors']=$errors;
        header("location:../../../view/user/login.php");
    }
}