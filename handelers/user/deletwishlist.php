<?php 

session_start();
require "../../core/dbconnect.php";



if(isset($_GET['pid']) && isset($_GET['uid'])){

    $u_id=$_GET['uid'];
    $p_id=$_GET['pid'];
    


    $deletewishlist=$database->prepare("DELETE FROM wishlist where p_id=:p_id AND u_id=:u_id ");

    $deletewishlist->bindParam("p_id",$p_id);
    $deletewishlist->bindParam("u_id",$u_id);
    $deletewishlist->execute();
    

    

        echo "<script type='text/javascript'> document.location = '../../view/user/wishlist.php'; </script>";

    

    
    
}        