<?php 
session_start();

require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";



if(isset($_POST['updatestatus'])){

$orderid=$_POST['orderid'];
$reason=$_POST['reason'];
$status=$_POST['status'];


$updatestatus=$database->prepare("INSERT INTO order_tracking (order_id,reason,status) VALUES(:o_id,:reasn,:status)");

$updatestatus->bindParam("o_id",$orderid);
$updatestatus->bindParam("reasn",$reason);
$updatestatus->bindParam("status",$status);

if($updatestatus->execute()){

    $updateorderstatus=$database->prepare("UPDATE orders set orderstatus=:status where id=:o_id");

    $updateorderstatus->bindParam("o_id",$orderid);
    $updateorderstatus->bindParam("status",$status);
    $updateorderstatus->execute();

    echo "<script type='text/javascript'> document.location = '../../../view/admin/all_orders.php'; </script>";



}

}        