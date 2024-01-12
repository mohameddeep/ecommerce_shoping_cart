<?php 

session_start();
require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";


if(isset($_POST['update'])){
    
        
  
    $userid=$_SESSION['user']['id'];
    
    $country=$_POST['country'];
    $company=$_POST['company'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $city=$_POST['city'];
    $code=$_POST['code'];
    $phone=$_POST['phone'];

    $updateaddress=$database->prepare("UPDATE user_data SET fname=:fnam,lname=:lnam,country=:cont,company=:compan,address1=:adr1,
    address2=:adr2,city=:cit,zip_code=:cod,mobile=:phone WHERE user_id =:id");

$updateaddress->bindParam("cont",$country);
$updateaddress->bindParam("fnam",$fname);
$updateaddress->bindParam("lnam",$lname);
$updateaddress->bindParam("compan",$company);
$updateaddress->bindParam("adr1",$address1);
$updateaddress->bindParam("adr2",$address2);
$updateaddress->bindParam("cit",$city);
$updateaddress->bindParam("cod",$code);
$updateaddress->bindParam("phone",$phone);
$updateaddress->bindParam("id",$userid);
$updateaddress->execute();
echo "<script type='text/javascript'> document.location = '../../../view/user/myaccount.php'; </script>";


   
    }