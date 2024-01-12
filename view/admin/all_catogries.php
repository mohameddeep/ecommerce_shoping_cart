<?php 
session_start();


if(!isset($_SESSION['admin']) && !isset($_SESSION['login'])){
    header("location:admin_login.php");
}

require "../../inc/admin/header.php";
require "../../inc/admin/nav.php";
require "../../core/dbconnect.php";


?>
<?php if(isset($_SESSION['message_delete'])){?>
                            <p class="text-danger bg-white" > <?php echo $_SESSION['message_delete']; ?></p>

                        <?php }?>
<div class="container pt-5">

<table class='table table-bordered bg-white'>
    <thead>
        <tr>
            <td>Name</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>

    <?php

    $allcatogries=$database->prepare("SELECT * FROM catogry");

    $allcatogries->execute();
    $rows=$allcatogries->fetchAll(PDO::FETCH_ASSOC);


    foreach($rows as $row){?>

        <tr>
        <td><?php echo $row["catogry_name"] ?></td>
        <td><a href='edit_catogry.php?id=<?php echo $row["id"] ?>'>Edit</a> 
        |<a href='../../handelers/admin/catogry/delete.php?id=<?php echo $row["id"] ?>'>Delete</a></td>
        </tr>

    <?php }
    
    
    
    
    ?>

    
        
        
        

        
        
       </tbody>
    
</table>
</div>

<?php 


require "../../inc/admin/footer.php";
?>