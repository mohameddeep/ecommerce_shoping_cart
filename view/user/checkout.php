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

<form Method="post" action="../../handelers/user/checkout/add.php">

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2>Shop - Checkout</h2>
						<p>Get the best kit for smooth shave</p>
					</div>
	
		<div class="container ">
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
						<h3 class="uppercase">Billing Details</h3>
						<div class="space30"></div>
					
							<label class="">Country </label>
							<select class="form-control" name="country">
								<option value="<?php if(isset($row['country'])){  echo $row['country']; } ?>"><?php if(isset($row['country'])){  echo $row['country']; }else{
									echo "select your country";
								} ?></option>
								<option value="eg" >egypt</option>
								<option value="AX" >Aland Islands</option>
								<option value="AF">Afghanistan</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
							</select>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label>First Name </label>
									<input class="form-control" name="fname" placeholder="" value="<?PHP if(isset($row['fname'])){  echo $row['fname']; }  ?>" type="text">
								</div>
								<div class="col-md-6">
									<label>Last Name </label>
									<input class="form-control" name="lname" placeholder="" value="<?php if(isset($row['lname'])){  echo $row['lname']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Company Name</label>
							<input class="form-control" name="company" placeholder="" value="<?php if(isset($row['company'])){  echo $row['company']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<label>Address </label>
							<input class="form-control" name="address1" placeholder="Street address" value="<?php if(isset($row['address1'])){  echo $row['address1']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<input class="form-control" name="address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(isset($row['address2'])){  echo $row['address2']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-4">
									<label>Town / City </label>
									<input name="city" class="form-control" placeholder="Town / City" value="<?php if(isset($row['city'])){  echo $row['city']; } ?>" type="text">
								</div>
								<!-- <div class="col-md-4">
									<label>County</label>
									<input class="form-control" value="" placeholder="State / County" type="text">
								</div> -->
								<div class="col-md-4">
									<label>Postcode </label>
									<input class="form-control" name="code" placeholder="Postcode / Zip" value="<?php if(isset($row['zip_code'])){  echo $row['zip_code']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<!-- <label>Email Address </label>
							<input class="form-control" placeholder="" value="" type="text"> -->
							<div class="clearfix space20"></div>
							<label>Phone </label>
							<input class="form-control" id="billing_phone" name="phone" placeholder="" value="<?php if(isset($row['mobile'])){  echo $row['mobile']; } ?>" type="text">
					
					</div>
				</div>
				
				
			</div>
			
			<div class="space30"></div>
			<h4 class="heading">Your order</h4>
			
			<table class="table table-bordered extra-padding bg-white text-dark">
				<tbody>
					<tr>
						<th>Cart Subtotal</th>
						<td><span class="amount">£<?php if(isset($_SESSION['total'])){ echo $_SESSION['total']; }  ?></span></td>
					</tr>
					<tr>
						<th>Shipping and Handling</th>
						<td>
							Free Shipping				
						</td>
					</tr>
					<tr>
						<th>Order Total</th>
						<td><strong><span class="amount">£<?php if(isset($_SESSION['total'])){ echo $_SESSION['total']; }  ?></span></strong> </td>
					</tr>
				</tbody>
			</table>
			
			<div class="clearfix space30"></div>
			<h4 class="heading">Payment Method</h4>
			<div class="clearfix space20"></div>
			
			<div class="payment-method mt-5">
        
				<div class="row d-flex">
				
						<div class="col-md-4">
							<input name="payment" id="radio1" value="visa" class="mr-2 css-checkbox" type="radio"><span>Direct Bank Transfer</span>
							<div class="space20"></div>
							<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
						</div>
						<div class="col-md-4">
							<input name="payment" id="radio2" value="Cheque" class="mr-2 css-checkbox" type="radio"><span>Cheque Payment</span>
							<div class="space20"></div>
							<p>Please send your cheque to BLVCK Fashion House, Oatland Rood, UK, LS71JR</p>
						</div>
						<div class="col-md-4">
							<input name="payment" id="radio3" value="paypal" class="mr-2 css-checkbox" type="radio"><span>Paypal</span>
							<div class="space20"></div>
							<p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account</p>
						</div>
				
                </div>
            
				<div class="space30"></div>
			
					<input name="agree" id="checkboxG2" class="mr-2 css-checkbox " type="checkbox"><span>I've read and accept the <a href="#">terms &amp; conditions</a></span>
					<?php if(isset($_SESSION['agree']) && !empty($_SESSION['agree'])){?>
                            <p class="text-danger"> <?php echo $_SESSION['agree']; ?></p>

                        <?php }?>
				<div class="space30"></div>
				<a href="#" class="button btn-lg">Pay Now</a>
			</div>
        </div>		
        
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" name="pay" value="pay now"class="btn">Pay Now</button>
            </div>
        </div>
		
		</div>
	</section>
</form>
</div>
<?php unset( $_SESSION['agree']);?>

<?php 
require "../../inc/user/footer.php";
?>