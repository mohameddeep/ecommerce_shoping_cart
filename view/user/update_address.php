<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}
require "../../core/dbconnect.php";
require "../../inc/user/header.php";
require "../../inc/user/nav.php";

?>

<?php

            if(isset($_GET['id'])){
            
                $id=$_GET['id'];
            
                $myddress=$database->prepare("SELECT * FROM user_data   WHERE user_id=:id");
                $myddress->bindParam("id",$id);
                $myddress->execute();
                $address=$myddress->fetch(PDO::FETCH_ASSOC);
            }
   ?>


<form Method="post" action="../../handelers/user/checkout/updateaddress.php">

    <section id="content">
		<div class="content-blog">
					
	
		<div class="container ">
			<div class="row mt-5 mb-2">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
						<h3 class="uppercase">update address</h3>
						<div class="space30"></div>
					
							<label class="">Country </label>
							<select class="form-control" name="country">
								<option value="<?php if(isset($address['country'])){  echo $address['country']; } ?>"><?php if(isset($address['country'])){  echo $address['country']; }else{
									echo "select your country";
								} ?></option>
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
									<input class="form-control" name="fname" placeholder="" value="<?PHP if(isset($address['fname'])){  echo $address['fname']; }  ?>" type="text">
								</div>
								<div class="col-md-6">
									<label>Last Name </label>
									<input class="form-control" name="lname" placeholder="" value="<?php if(isset($address['lname'])){  echo $address['lname']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Company Name</label>
							<input class="form-control" name="company" placeholder="" value="<?php if(isset($address['company'])){  echo $address['company']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<label>Address </label>
							<input class="form-control" name="address1" placeholder="Street address" value="<?php if(isset($address['address1'])){  echo $address['address1']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<input class="form-control" name="address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(isset($address['address2'])){  echo $address['address2']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-4">
									<label>Town / City </label>
									<input name="city" class="form-control" placeholder="Town / City" value="<?php if(isset($address['city'])){  echo $address['city']; } ?>" type="text">
								</div>
								
								<div class="col-md-4">
									<label>Postcode </label>
									<input class="form-control" name="code" placeholder="Postcode / Zip" value="<?php if(isset($address['zip_code'])){  echo $address['zip_code']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							
							<div class="clearfix space20"></div>
							<label>Phone </label>
							<input class="form-control" id="billing_phone" name="phone" placeholder="" value="<?php if(isset($address['mobile'])){  echo $address['mobile']; } ?>" type="text">
					
					</div>
				</div>
				
				
			</div>
			
			
			
			
			
        </div>		
        
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <button type="submit" name="update" value="update address"class="btn">update address</button>
            </div>
        </div>
		
		</div>
	</section>
</form>



<?php 
require "../../inc/user/footer.php";
?>