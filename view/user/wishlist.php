<?php 
session_start();
if(!isset($_SESSION['user']['id'])){
    header("location:index.php");
}else{
    $p_id=$_GET['id'] ?? "";
    $u_id=$_SESSION['user']['id'];

}


require "../../core/dbconnect.php";
require "../../inc/user/header.php";

$checkwishlist=$database->prepare("SELECT * FROM wishlist where p_id=:p_id AND u_id=:u_id");
$checkwishlist->bindParam("p_id",$p_id);
$checkwishlist->bindParam("u_id",$u_id);
$checkwishlist->execute();
if($checkwishlist->rowCount()== 1){
    $_SESSION['wishlist']="you are added before";
}else{
    if(isset($p_id)){
        $insertwishlist=$database->prepare("INSERT INTO  wishlist (p_id,u_id)  VALUES(:product_id,:user_id)");
    $insertwishlist->bindParam("product_id",$p_id);
    $insertwishlist->bindParam("user_id",$u_id);
    $insertwishlist->execute();

    }
    
    
}
?>

<div class="container text-white">
    <h2 class='text-center text-white'>my wishlist</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
				 
					<div class="col-md-12">

			
			<br>
			<table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>product name</th>
						<th>price</th>
						<th>date and time</th>
						<th>actions</th>
					</tr>
				</thead>
				<tbody>
                    

                <?php
                // $allwishlist=$database->prepare("SELECT * FROM wishlist where p_id=:p_id AND u_id=:u_id");
                // $allwishlist->bindParam("p_id",$p_id);
                // $allwishlist->bindParam("u_id",$u_id);
                // $allwishlist->execute();
                // if($allwishlist->rowCount() > 0){
                //     $mywishlists=$allwishlist->fetchAll(PDO::FETCH_ASSOC);
                $allwishlist=$database->prepare("SELECT * FROM wishlist join product on product.id=wishlist.p_id");
                // $allwishlist->bindParam("p_id",$p_id);
                $allwishlist->execute();
                $mywishlists=$allwishlist->fetchall(PDO::FETCH_ASSOC);
                    foreach($mywishlists as $mywish){

                        
                        

                   
                 ?>
					
					<tr>
						<td>
							<?php echo $mywish['product_name'] ?? "" ?>
						</td>
						<td>

						<?php echo $mywish['price'] ?? "" ?>
						</td>
						<td>
                        <?php echo $mywish['timestamp'] ?>
                      		
						</td>
                        
						<td>
                        <a href="../../handelers/user/deletwishlist.php?pid=<?php echo$mywish['p_id']?>&uid=<?php echo$mywish['u_id']?> " class=" pull-left">
                            delete
                    </a>
						</td>
					</tr>

                    <?php
                     }
                    
                     ?>


                    

                   
				</tbody>
			</table>		

		 

			

					</div>
				</div>
			</div>
		</div>
	</section>
	
 
</div>

<?php 

require "../../inc/user/footer.php";
?>
