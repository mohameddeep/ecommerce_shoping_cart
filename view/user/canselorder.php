<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}

require "../../core/dbconnect.php";
require "../../inc/user/header.php";
require "../../inc/user/nav.php";

//var_dump($_SESSION);
// if(isset($_POST['pay'])){
// 	echo "<pre>";
// 	print_r($_POST);
// 	echo "</pre>";
// }
$userid=$_SESSION['user']['id'];
$alldata=$database->prepare("SELECT * FROM user_data where user_id=:userid");
$alldata->bindParam("userid",$userid);
$alldata->execute();

$row=$alldata->fetch(PDO::FETCH_ASSOC);
?>

<div class="container text-white">

<form Method="post" action="../../handelers/user/order/cancel.php">
    <input type="hidden" name="orderid" value="<?php echo $_GET['id']; ?>">

    <section id="content">
		<div class="content-blog">
	
		<div class="container ">
        
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
                    <h2 class='text-center text-white mt-5 mb-3'>cansel order</h2>
						<div class="space30"></div>
							<div class="row">
                            <div class="col-md-12">
			<table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>quantity</th>
						<th>price</th>
						<th>total price</th>
						<th>product name</th>
						
					</tr>
				</thead>
				<tbody>
                    <?php
                    if(isset($_GET['id'])){
                        $order_id=$_GET['id'];

                    }
                    $userid=$_SESSION['user']['id'];
                   
                    $orderitems=$database->prepare("SELECT * FROM orderitems where order_id =:o_id  ");
                    $orderitems->bindParam("o_id",$order_id);
                    $orderitems->execute();
                    $items=$orderitems->fetchAll(PDO::FETCH_ASSOC);


                    foreach($items as $item){
                        $product_nam=$item['product_id'];

                    
                    
                    ?>
					
					<tr>
						<td>
							<?php echo $item['quantity']; ?>
						</td>
						<td>
						<?php echo $item['totalprice']; ?>
						</td>
						<td>
                        <?php echo $item['quantity'] * $item['totalprice'] ; ?>		
						</td>
						<td>
                            <?php
                             $productname=$database->prepare("SELECT * FROM product where id =:p_id  ");
                             $productname->bindParam("p_id",$product_nam);
                             $productname->execute();
                             $pname=$productname->fetch(PDO::FETCH_ASSOC);
                             ?>
                        <?php echo $pname['product_name']; ?>			
						</td>
						
					</tr>

                    <?php } ?>

                    <?php
                     $totalorder=$database->prepare("SELECT * FROM orders where id =:o_id  and user_id=:u_id ");
                     $totalorder->bindParam("o_id",$order_id);
                     $totalorder->bindParam("u_id",$userid);
                     $totalorder->execute();
                     $torder=$totalorder->fetch(PDO::FETCH_ASSOC);
                            ?>

                    <tr>
						<th></th>
						<th></th>
						<th>total price</th>
						<th><?php echo $torder['totalprice'] ?></th>
					</tr>
                    <tr>
						<th></th>
						<th></th>
						
						<th>order status</th>
						<th><?php echo $torder['orderstatus'] ?></th>
					</tr>
                    <tr>
						<th></th>
						<th></th>
					
						<th>date and time</th>
						<th><?php echo $torder['timestamp'] ?></th>
					</tr>
				</tbody>
			</table>
                            </div>
                            <h3 class='text-center text-white mt-5 mb-3'>reason</h3>
                           
						<div class="col-md-12">
                                <div class="clearfix space20"></div>
                                    <textarea name="reason" id=""  cols="100" rows="10">write your reason to cansel a order</textarea>
							
						</div>
							
								
							</div>
							
							
							
					</div>
				</div>
				
				
			</div>
			
			
			<div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" name="cansel" value="cansel order"class="btn mb-5">cansel order</button>
            </div>
        </div>
			
		
		</div>
	</section>
</form>
</div>


<?php 
require "../../inc/user/footer.php";
?>