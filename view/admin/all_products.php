<?php 
session_start();


if(!isset($_SESSION['admin']) && !isset($_SESSION['login'])){
    header("location:admin_login.php");
}

require "../../inc/admin/header.php";
require "../../inc/admin/nav.php";
require "../../core/dbconnect.php";


?>
<div class="container pt-5">
<table class='table table-bordered bg-white'>
    <thead>
        <tr>
            <td>Name</td>
            <td>description</td>
            <td>price</td>
            <td>catogry_name</td>
            <td>image</td>
            <td>action</td>
        </tr>
    </thead>
    <tbody>

    <?php

    $allproducts=$database->prepare("SELECT product_name,product_descr,price,catogry_name,product_image,product.id as p_id 
    FROM product left join catogry on product.catogry_id = catogry.id");

    $allproducts->execute();
    $rows=$allproducts->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($rows);


    foreach($rows as $row){?>

        <tr>
        <td><?php echo $row["product_name"] ?></td>
        <td><?php echo $row["product_descr"] ?></td>
        <td><?php echo $row["price"] ?></td>
        <td><?php echo $row["catogry_name"] ?? "" ?></td>
        <td><?php echo $row["product_image"] ?></td>
        <td><a href='edit_product.php?id=<?php echo $row["p_id"] ?>'>Edit</a> 
        |<a href='../../handelers//admin/product/delete.php?id=<?php echo $row["p_id"] ?>'>Delete</a></td>
        </tr>

    <?php }
    
    
    
    
    ?>

    
        
        
        

        
        
       </tbody>
    
</table>
</div>

<?php 


require "../../inc/admin/footer.php";
?>