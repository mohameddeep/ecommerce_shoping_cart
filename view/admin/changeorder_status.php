<?php 
session_start();


if(!isset($_SESSION['admin']) && !isset($_SESSION['login'])){
    header("location:admin_login.php");
}

require "../../inc/admin/header.php";
require "../../inc/admin/nav.php";
require "../../core/dbconnect.php";


?>

<div class="container text-white">

<form Method="post" action="../../handelers/admin/order/change_status.php">
    <input type="hidden" name="orderid" value="<?php echo $_GET['id']; ?>">

    <section id="content">
		<div class="content-blog">
	
		<div class="container ">
        
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
                    <h2 class='text-center text-white mt-5 mb-3'>change order status</h2>
						<div class="space30"></div>
							<div class="row">
                            <div class="col-md-12">
			<table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>product</th>
						<th>total price</th>
						<th>payment mode price</th>
						<th>status</th>
						
					</tr>
				</thead>
				<tbody>
                    <?php
                    if(isset($_GET['id'])){
                        $order_id=$_GET['id'];

                    }
                
                   
                    $orderitems=$database->prepare("SELECT * FROM orders where id =:o_id  ");
                    $orderitems->bindParam("o_id",$order_id);
                    $orderitems->execute();
                    $items=$orderitems->fetchAll(PDO::FETCH_ASSOC);


                    foreach($items as $item){
                        

                    
                    
                    ?>
					
					<tr>
						<td>
						<?php
                             $producid=$database->prepare("SELECT * FROM orderitems where order_id =:o_id  ");
                             $producid->bindParam("o_id",$order_id);
                             $producid->execute();
                             $pid=$producid->fetch(PDO::FETCH_ASSOC);
                             $pid=$pid['product_id'];

                             $produtname=$database->prepare("SELECT * FROM product where id =:p_id  ");
                             $produtname->bindParam("p_id",$pid);
                             $produtname->execute();
                             $pname=$produtname->fetch(PDO::FETCH_ASSOC);
                             $name_product=$pname['product_name'];
                             


                             ?>
                        <?php echo $name_product ?>		
						</td>
						<td>
						<?php echo $item['totalprice']; ?>
						</td>
						<td>
                        <?php echo $item['paymentmode'] ?>		
						</td>
						<td>
                        <?php echo $item['orderstatus'] ?>
						</td>
						
					</tr>

                    <?php } ?>

				</tbody>
			</table>
                            </div>
                            <select name="status" class="form-select" aria-label="Default select example">
                                <option selected>select order status</option>
                                <option value="delivered">delivered</option>
                                <option value="dispatched">dispatched</option>
                                <option value="canceled">canceled</option>
                                <option value="on progress">on progress</option>
                            </select>
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
                <button type="submit" name="updatestatus" value="update status"class="btn mb-5">change order status</button>
            </div>
        </div>
			
		
		</div>
	</section>
</form>
</div>








<?php 


require "../../inc/admin/footer.php";
?>