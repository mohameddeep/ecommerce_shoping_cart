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
$querry="SELECT * FROM product";

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $querry.=" where catogry_id=:id";
    $addcart=$database->prepare($querry);
    $addcart->bindParam("id",$id);
    
}else{
    $addcart=$database->prepare($querry);

}


$addcart->execute();
$rows=$addcart->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="content mt-5">


            <ul class="rig columns-4">

            <?php foreach($rows as $row){?>
                <li class="mb-5">
                    <a href="#"><img class="product-image" src="../../inc/files/<?php echo $row['product_image'] ?>"></a>
                    <h4><?php echo $row['product_name'] ?></h4>
                     
                    <p><?php echo $row['product_descr'] ?>...</p>
                    <div class="price"> $<?php echo $row['price']?></div>
                    
                    <hr>
                    <a href="../../handelers/user/Cart/addcart.php?id=<?php echo $row['id']?> " class="btn btn-default btn-xs pull-right" >
                        <i class="fa fa-cart-arrow-down"></i> Add To Cart
            </a>
                    <a href="single.php?id=<?php echo $row['id']?> " class="btn btn-default btn-xs pull-left">
                        <i class="fa fa-eye"></i> Details
                    </a>
                </li>


                <?php } ?>
                
            </ul>
        </div>




        <?php 


require "../../inc/user/footer.php";
?>




