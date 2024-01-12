<?php 
session_start();
require "../../core/dbconnect.php";
require "../../core/validation.php";
require "../../core/functions.php";


if(isset($_POST['add'])){

    $review=$_POST['review'];
    $p_id=$_POST['p_id'];
    $u_id=$_SESSION['user']['id'];


    $addreview=$database->prepare("INSERT INTO review (u_id,p_id,review) VALUES(:u_id,:p_id,:rev)");

    $addreview->bindParam("u_id",$u_id);
    $addreview->bindParam("p_id",$p_id);
    $addreview->bindParam("rev",$review);
    $addreview->execute();
    echo "<script type='text/javascript'> document.location = '../../view/user/single.php'; </script>";
    //header("location:../../view/user/single.php");


}