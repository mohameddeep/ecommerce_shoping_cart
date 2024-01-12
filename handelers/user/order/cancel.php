<?php 

session_start();
require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";


if(isset($_POST['cansel'])){

    $orderid=$_POST['orderid'];
    $reason=$_POST['reason'];
    $status="canceled";


    $canselorder=$database->prepare("INSERT INTO order_tracking (order_id,reason,status) VALUES(:o_id,:reasn,:status)");

    $canselorder->bindParam("o_id",$orderid);
    $canselorder->bindParam("reasn",$reason);
    $canselorder->bindParam("status",$status);

    if($canselorder->execute()){

        $updatestatus=$database->prepare("UPDATE orders set orderstatus=:status where id=:o_id");

        $updatestatus->bindParam("o_id",$orderid);
        $updatestatus->bindParam("status",$status);
        $updatestatus->execute();

        echo "<script type='text/javascript'> document.location = '../../../view/user/myaccount.php'; </script>";

    

    }
    
}        