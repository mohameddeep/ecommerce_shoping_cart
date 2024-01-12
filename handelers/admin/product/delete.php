<?php 

require "../../../core/dbconnect.php";




if(isset($_GET['id'])){

    $product_id=$_GET['id'];


    

   
        $deleteproduct=$database->prepare("DELETE  FROM product WHERE id=:pro_id ");

        $deleteproduct->bindParam("pro_id",$product_id);

        if($deleteproduct->execute()){

            $_SESSION['message_delete']="product deleted successfully";

            header("location:../../../../view/admin/all_products.php");
         
   
}
}