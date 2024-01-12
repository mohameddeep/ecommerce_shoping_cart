
<?php 
 session_start();
// if(!isset($_SESSION['user_data']) && !isset($_SESSION['login_user'])){
//     header("location:login.php");
// }
include('../../inc/user/header.php');
include('../../core/dbconnect.php');


  ?>

<?php
include('../../inc/user/nav.php');
 ?>


 
<div class="container">
    <h2 class='text-center text-white'>Cart</h2>

   <table class="table table-bordered bg-white">
   <tr>
           <th>Image</th>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Total</th>
           <th>action</th>
       </tr>
       
   <?php 

   
   $total=0;
   if(isset($_SESSION['cart'])){

    //print_r($_SESSION['cart']);
    $cart=$_SESSION['cart'];

   
 

foreach($cart as $key => $value){
   echo $key;
    
    $query=$database->prepare("SELECT * FROM product WHERE id=:cart_key");

    $query->bindParam("cart_key",$key);
    $query->execute();

    $row=$query->fetch(PDO::FETCH_ASSOC);

   


    
    ?>



    
         <tr>
            <td><img src="../../inc/files/<?php echo $row['product_image'] ?>" alt=""></td>
            <td><a href="single.php?id=<?php echo $row['id']?> " class=" pull-left">
            <?php echo $row['product_name'] ?>
                    </a></td>
            <td>$ <?php echo $row['price'] ?></td>
            <td><?php echo $value['quantity'] ?></td>
            <td>$ <?php echo   ($row['price']  *  $value['quantity']) ?></td>
            <td><a href="../../handelers/user/cart/removecart.php?id=<?php echo $key?> " class=" pull-left">
            remove
                    </a></td>
         </tr>
         <?php
         $total+=$row['price']  *  $value['quantity']
         ?>

         <?php 
         } 
         }
?>
   </table>

   <div class="text-right">
    <!-- <button class="btn mr-3">Update Cart</button> -->
    <a href="checkout.php"> <button class="btn">Checkout</button></a>
   
</div>

<div class="card mb-5">
    <div class="card-header">
        Total
    </div>
    <div class="card-body">
        total amount: <?php echo $total?>


    </div>
</div>
</div>







 
</body>
</html>