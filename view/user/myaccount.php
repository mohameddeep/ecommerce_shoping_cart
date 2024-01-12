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
    <h2 class='text-center text-white'>My Account</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
				 
					<div class="col-md-12">

			<h3>Recent Orders</h3>
			<br>
			<table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>totalprice</th>
						<th>payment mode</th>
						<th>Status</th>
						<th>time</th>
						<th>actions</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $userorder=$_SESSION['user']['id'];
                    $userorders=$database->prepare("SELECT * FROM orders where user_id =:userorder");
                    $userorders->bindParam("userorder",$userorder);
                    $userorders->execute();
                    

                    if($userorders->rowCount() > 0){

                        $rows=$userorders->fetchAll(PDO::FETCH_ASSOC);


                    foreach($rows as $order){

                    
                    
                    ?>
					
					<tr>
						<td>
							<?php echo $order['totalprice'] ?? ""; ?>
						</td>
						<td>
						<?php echo $order['paymentmode'] ?? ""; ?>
						</td>
						<td>
                        <?php echo $order['orderstatus'] ?? ""; ?>		
						</td>
						<td>
                        <?php echo $order['timestamp'] ?? ""; ?>			
						</td>
						<td>
							<a href="show_order.php?id=<?php echo $order['id'] ?? "" ?>">View </a>
							<?php if($order['orderstatus'] != "canceled" ){?>
								<a href="canselorder.php?id=<?php echo $order['id'] ?? ""?>"> \ cansel</a>
							<?php } ?>
							
						</td>
					</tr>

                    <?php }
                    }
                     ?>
				</tbody>
			</table>		

		 

			<div class="ma-address">
						<h3>My Addresses</h3>
						<p>The following addresses will be used on the checkout page by default.</p>

			<div class="row  bg-white text-dark px-5 py-3">
				<?php 

				$address=$database->prepare("SELECT * FROM user_data WHERE user_id=:u_id");
				$address->bindParam("u_id",$userorder);
				$address->execute();
				
					$userone=$address->fetch(PDO::FETCH_ASSOC);

				
				
				?>
				<div class="col-md-6">
								<h4>Billing Address <a href="update_address.php?id=<?php echo $userorder ?>">Edit</a></h4>
					<p>
					<b>full name:</b> 	<?php if(isset($userone['fname'])){ echo $userone['fname'] . " " . $userone['lname']; } ?> <br>
					<b>country:</b>	<?php if(isset($userone['country'])){ echo $userone['country']; } ?><br>
					<b>company:</b>	<?php if(isset($userone['company'])){ echo $userone['company']; } ?><br>
					<b>address:</b>		<?php if(isset($userone['address1'])){  echo $userone['address1'] . " or " .$userone['address2']; } ?><br>
					<b>city:</b>	<?php if(isset($userone['city'])){   echo $userone['city']; }  ?><br>
					<b>mobile:</b>	<?php if(isset($userone['city'])){   echo $userone['mobile']; } ?><br>
					<b>code:</b>		<?php if(isset($userone['city'])){   echo $userone['zip_code']; } ?><br>
			
					</p>
				</div>

				
			</div>



			</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	
 
</div>







<?php require "../../inc/user/footer.php";  ?>


