<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">shooping cart </a>

  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item mt-2">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item mt-2">
      <a class="nav-link" href="">Shop</a>
    </li>
	
    
	<li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            my account
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="../../handelers/user/auth/logout.php">logout </a>
          <a class="dropdown-item" href="myaccount.php">my account</a> 
          <a class="dropdown-item" href="wishlist.php">wishlist</a> 
        </div>
      </li>

	<li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Categories
        </a>
        <div class="dropdown-menu">
			<?php
	
			$items=$database->prepare("SELECT * FROM catogry");
			$items->execute();

			$rows=$items->fetchAll(PDO::FETCH_ASSOC);

			foreach($rows as $row){
			 ?>

          <a class="dropdown-item" href="index.php?id=<?php echo $row['id'];?>"><?php echo $row['catogry_name']; ?></a>
           

		  <?php } ?>
        </div>
      </li>
   

    <!-- Dropdown -->

    <div class='text-right ml-5'>
    <li class="nav-item dropdown">
      
              <div class="dropdown">
				    <button type="button" class="btn btn-info" data-toggle="dropdown">
				     <i class="fa fa-shopping-cart" aria-hidden="true"></i>
					  Cart <span class="badge badge-pill badge-danger"><?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']); }?></span>
				    </button>
				    <div class="dropdown-menu">
				    	<div class="row total-header-section">
			      			<div class="col-lg-6 col-sm-6 col-6">
			      				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								 <span class="badge badge-pill badge-danger"><?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']); }?></span>
			      			</div>

							 
			      			
				    	</div>
<?php 

  
if(isset($_SESSION['cart'])){
	//var_dump($_SESSION['cart']);
$cart=$_SESSION['cart']; 
$total=0;

foreach($cart as $key => $value){
    
    $query=$database->prepare("SELECT * FROM product WHERE id=:cart_key");

    $query->bindParam("cart_key",$key);
    $query->execute();

    $row=$query->fetch(PDO::FETCH_ASSOC);
	// print_r($row);
	// die;

   
	$total+=$row['price']  *  $value['quantity'];
	$_SESSION['total']=$total;
    
    
    ?>
				    	<div class="row cart-detail">
		    				<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
		    					<img src="../../inc/files/<?php echo $row['product_image'] ?>">
		    				</div>
		    				<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
		    					<p><?php echo $row['product_name'] ?>..</p>
		    					<span class="price text-info"> $ <?php echo $row['price'] ?></span> <span class="count"> Quantity:<?php echo $value['quantity'] ?></span>
		    				</div>
				    	</div>
						<?php } ?>
				    	<div class="col-lg-8 col-sm-6 col-6 total-section text-right">
			      				<p>Total salary: <span class="text-info">$ <?php echo $total ?></span></p>
			      			</div>
				    	<?php }else{
							$car=null;
						} ?>
				    	<div class="row">
				    		<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
				    			<button class="btn btn-primary btn-block"> <a 
								 class="col-lg-12 col-sm-12 col-12 text-center checkout" href="checkout.php" class=" pull-left">
								checkout
                    </a></button>
				    		</div>
				    	</div>
				    	<div class="row">
				    		<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
				    			<button class="btn btn-primary btn-block"> <a 
								 class="col-lg-12 col-sm-12 col-12 text-center checkout" href="cart.php" class=" pull-left">
								cart
                    </a></button>
				    		</div>
				    	</div>
				    </div>
				</div>
                




    </li>
    </div>

  </ul>
</nav>