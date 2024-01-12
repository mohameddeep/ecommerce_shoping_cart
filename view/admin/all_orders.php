<?php 

session_start();
// var_dump($_SESSION);

if(!isset($_SESSION['admin']) && !isset($_SESSION['login'])){
    header("location:admin_login.php");
}

require "../../inc/admin/header.php";
require "../../inc/admin/nav.php";
require "../../core/dbconnect.php";

?>


<div class="container">

<div class="card">
    <div class="card-header">
        all orders
    </div>
    <div class="card-body">
   
<table class='table table-bordered bg-white'>
    <thead>
        <tr>
            <td>full name</td>
            <td>total price</td>
            <td>order status</td>
            <td>payment mode</td>
            <td>date and time</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>

  
    <?php
        
        $statment=$database->prepare("SELECT orders.totalprice,orders.orderstatus,orders.paymentmode,orders.timestamp,orders.id,orders.user_id,
        user_data.user_id,user_data.fname,user_data.lname
        FROM orders  join  user_data on orders.user_id = user_data.user_id order by orders.id DESC");
        $statment->execute();
        if($statment->rowCount() >0){
            $orders=$statment->fetchAll(PDO::FETCH_ASSOC);

        
        }
    ?>
<?php foreach($orders as $order){ ?>
        <tr>
        <td><?php echo $order['fname'] . " " . $order['fname'] ?? ""?></td>
        <td><?php echo $order['totalprice'] ?? ""?></td>
        <td><?php echo $order['orderstatus'] ?? "" ?></td>
        <td><?php echo $order['paymentmode'] ?? "" ?></td>
        <td><?php echo $order['timestamp'] ?? "" ?></td>
        <td><a href="changeorder_status.php?id=<?php echo $order['id'] ?? "" ?>" >change status</a> 
       
        </tr>

        <?php } 
         ?>
       </tbody>
    
</table>
      
                </div>
            </div>



            </div>

<?php 


require "../../inc/admin/footer.php";
?>