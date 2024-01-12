<?php 
session_start();
require "../../../core/dbconnect.php";
require "../../../core/validation.php";
require "../../../core/functions.php";


if(isset($_POST['pay'])){
    if( isset($_POST['payment']) && isset($_POST['agree']) ){
        
  
    $userid=$_SESSION['user']['id'];
    $totalprice=$_SESSION['total'] ?? "";
    $country=$_POST['country'];
    $company=$_POST['company'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $city=$_POST['city'];
    $code=$_POST['code'];
    $phone=$_POST['phone'];
    $payment=$_POST['payment'];
    $agree=$_POST['agree'];


    $user=$database->prepare("SELECT * FROM user_data where  user_id =:userid");
    $user->bindParam("userid",$userid);
    $user->execute();


    if($user->rowCount() ==1){
        $update=$database->prepare("UPDATE user_data set country=:count,fname=:fnam,lname=:lnam,company=:company,address1=:adr1,
        address2=:adr2,city=:cit,zip_code=:cod,mobile=:phone where user_id=:userid");
       $update->bindParam("count",$country);
       $update->bindParam("fnam",$fname);
       $update->bindParam("lnam",$lname);
       $update->bindParam("company",$company);
       $update->bindParam("adr1",$address1);
       $update->bindParam("adr2",$address2);
       $update->bindParam("cit",$city);
       $update->bindParam("cod",$code);
       $update->bindParam("phone",$phone);
       $update->bindParam("userid",$userid);
       $update->execute();
       if($update){
        $insertorder=$database->prepare("INSERT INTO  orders(user_id,totalprice,paymentmode,orderstatus) 
        VALUES(:userid,:totalprice,:payment,'placed')");
          $insertorder->bindParam("userid",$userid);
          $insertorder->bindParam("totalprice",$totalprice);
          $insertorder->bindParam("payment",$payment);
        // $insertorder->bindParam("status",'order placed');
        //   $insertorder->execute();

          if($insertorder->execute()){
            $orderid=$database->lastInsertId();
            if(isset($_SESSION['cart'])){
            $cart=$_SESSION['cart']; 
        //   $key=null;
            foreach($cart as $key => $value){
                
                $query=$database->prepare("SELECT * FROM product WHERE id=:cart_key");
            
                $query->bindParam("cart_key",$key);
                $query->execute();
                $row=$query->fetch(PDO::FETCH_ASSOC);

                $add=$database->prepare("INSERT INTO  orderitems(order_id,product_id,quantity,totalprice) 
                VALUES(:orderid,:productid,:quant,:price)");
    
                $add->bindParam("orderid",$orderid);
                $add->bindParam("productid",$key);
                $add->bindParam("quant",$value['quantity']);
                $add->bindParam("price",$row['price']);
                // $add->execute();
                if( $add->execute()){
                    echo "done";
                    echo "<script type='text/javascript'> document.location = '../../../view/user/myaccount.php'; </script>";
                    // header("loation:../../../view/user/myaccount.php.php");
                
            }
                }
           

            }
          }
       
       }
    
    }else{
        $inserted=$database->prepare("INSERT INTO  user_data(country,fname,lname,company,address1,address2,city,zip_code,mobile,user_id) 
        VALUES(:count,:fnam,:lnam,:company,:adr1,:adr2,:cit,:cod,:phone,:userid)");
$inserted->bindParam("count",$country);
$inserted->bindParam("fnam",$fname);
$inserted->bindParam("lnam",$lname);
$inserted->bindParam("company",$company);
$inserted->bindParam("adr1",$address1);
$inserted->bindParam("adr2",$address2);
$inserted->bindParam("cit",$city);
$inserted->bindParam("cod",$code);
$inserted->bindParam("phone",$phone);
$inserted->bindParam("userid",$userid);
$inserted->execute();

header("loation:../../view/user/checkout.php");
    }
}else{
        $_POST['agree']=false;
        $_POST['payment']=false;
        $_SESSION['agree']="you must choose payment and agree on that";
        echo "<script type='text/javascript'> document.location = '../../../view/user/checkout.php'; </script>";
        // header("loation:../../../view/user/checkout.php");
        
     
    
}
}