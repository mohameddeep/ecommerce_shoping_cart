
<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}
require "../../core/dbconnect.php";
require "../../inc/user/header.php";
require "../../inc/user/nav.php";



if(isset($_GET['id'])){
    $id=$_GET['id'];

    $querry=$database->prepare("SELECT * FROM product WHERE id=:get_id");
    $querry->bindParam("get_id",$id);
    $querry->execute();
    $row=$querry->fetch(PDO::FETCH_ASSOC);
}

?>


 
<div class="container">
    <form action="../../handelers/user/cart/addcart.php" method="get">
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">

    <div class="row text-white mt-5">
        <div class="col-md-6 ">
            <img src="../../inc/files/<?php echo $row['product_image'];?>" alt="" class='img-fluid' style='height:500px;width:500px;'>
        </div>
        <div class="col-md-6 pt-5">
        <h3><b><?php echo $row['product_name']; ?></b></h3>
        <h2>$ <?php echo $row['price']; ?></h2>
<p><?php echo $row['product_descr']; ?></p>            
       
<div class="row">
    <div class="col-md-2">
        Quantity:
    </div>
    <div class="col-md-2">
        <input type="text" name="quantity" class='form-control'>
    </div>
   
</div>
<div class="row ">
    <?php
    
    $sql=$database->prepare("SELECT * FROM catogry WHERE id=:get_id");
    $sql->bindParam("get_id",$row['catogry_id']);
    $sql->execute();
    if($sql->rowCount() == 1){
       $row2=$sql->fetch(PDO::FETCH_ASSOC);?>

<div class="col-md-12 category">
        Categories - <a href="index.php?id=<?php echo $row['catogry_id']; ?>"> <?php echo $row2['catogry_name']; ?></a>
    </div>
    
    <?php //var_dump($rows);
    }
    
     
     ?>
    
    <!-- <div class="col-md-12 category">
        Tags - <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a>
    </div> -->
</div>
<div class="row mt-4">
    <div class="col-md-4">
        <button type="submit" class='btn'>Add to Cart</button>
    </div>
    <div class="col-md-4">
        <a href="wishlist.php?id=<?php echo $id; ?>"  class="btn btn-default btn-xs pull-left"><i class="fa fa-heart"></i>wishlist</a>
    </div>
</div>
</form>


</div>
        
        </div>


<br>

<div class="tab_class">
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">Details</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Reviews</button>
 
</div>

<!-- Tab content -->
<div id="London" class="tabcontent">
  <h3><?php echo $row['product_descr']; ?></h3>
  <!-- <p>London is the capital city of England.</p> -->
</div>

<div id="Paris" class="tabcontent">
  <h3>All reviews:- </h3>
  <ul>
    <?php
    $reviews=$database->prepare("SELECT * from review where p_id=:p_id");
    $reviews->bindParam("p_id",$id);
    $reviews->execute();
    $allreviews=$reviews->fetchAll(PDO::FETCH_ASSOC);
     foreach($allreviews as $review){?>

     
    <li>
        <?php 
    $fullname=$database->prepare("SELECT fname,lname from user_data where user_id=:u_id");
    $fullname->bindParam("u_id",$review['u_id']);
    $fullname->execute();
    $fname=$fullname->fetchAll(PDO::FETCH_ASSOC);
     foreach($fname as $name){?>


<p><?php echo $name['fname'] ." " . $name['lname'] . " at " . $review['time'] ; ?></p><?php }?>

<p><?php echo $review['review']; ?></p>
    </li>
    <?php 
}
     ?>
  </ul>
  <h4 class="mt-3">add review</h4>

                                       <!-- <p>check if user add review or not</p> -->
  <?php 
   $check=$database->prepare("SELECT * from review where u_id=:u_id AND p_id=:p_id");
   $check->bindParam("u_id",$_SESSION['user']['id']);
   $check->bindParam("p_id",$id);
   $check->execute();
   if($check->rowCount() > 0){?>
   <div class="text-center">you have aleady add review </div>

   <?php }else{ ?>
 
  <form action="../../handelers//user/addreview.php" method="post" class="mt-1">
    <input type="hidden" name="p_id" value="<?php echo $id; ?>">
 
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label"></label>
  <textarea name="review" class="form-control" id="exampleFormControlTextarea1" rows="4">add review......</textarea>
</div>
<div class="mb-3">
<button type="submit" name="add" class="btn btn-primary mb-3">add review</button>
</div>


  </form>
  <?php } ?>
  
</div>

</div>

<div class="columns-4">
 <p class="title">related products</p>
 </div>
<ul class="rig bg-white columns-3">
 
    <?php

 $realatedproducts=$database->prepare("SELECT * FROM product where id!=:p_id order by rand()  limit 3");
    $realatedproducts->bindParam("p_id",$id);
    $realatedproducts->execute();
    $items=$realatedproducts->fetchAll(PDO::FETCH_ASSOC);
    

    foreach($items as $item ){?>



                <li>
                    <a href="#"><img class="product-image" src="../../inc/files/<?php echo $item['product_image'] ?>"></a>
                    <h4><?php echo $item['product_name']; ?></h4>
                     
                    <p><?php echo $item['product_descr']; ?></p>
                    <div class="price"> $ <?php echo $item['price']; ?></div>
                    
                    <hr>
                    <button class="btn btn-default btn-xs pull-right" type="button">
                        <i class="fa fa-cart-arrow-down"></i> Add To Cart
                    </button>
                    <a href="single.php?id=<?php echo $item['id']?> " class="btn btn-default btn-xs pull-left">
                        <i class="fa fa-eye"></i> Details
                    </a>
                </li>
               

           <?php }

?>
                </ul>


                



</div>


<?php 


require "../../inc/user/footer.php";
?>