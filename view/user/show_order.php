<?php

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}
require "../../core/dbconnect.php";
require "../../inc/user/header.php";
require "../../inc/user/nav.php";
            ?>



<div class="container text-white">
    <h2 class='text-center text-white'>show order</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
				 
					<div class="col-md-12">

			
			<br>
			<table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>quantity</th>
						<th>price</th>
						<th>total price</th>
						<th>product name</th>
						<th>actions</th>
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
						<td>
							<a href="#">View</a>
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
						<th> </th>
						<th>total price</th>
						<th><?php echo $torder['totalprice'] ?></th>
					</tr>
                    <tr>
						<th></th>
						<th></th>
						<th></th>
						<th>order status</th>
						<th><?php echo $torder['orderstatus'] ?></th>
					</tr>
                    <tr>
						<th></th>
						<th></th>
						<th> </th>
						<th>date and time</th>
						<th><?php echo $torder['timestamp'] ?></th>
					</tr>
				</tbody>
			</table>		

		 

			

					</div>
				</div>
			</div>
		</div>
	</section>
	
 
</div>







<?php require "../../inc/user/footer.php";  ?>
