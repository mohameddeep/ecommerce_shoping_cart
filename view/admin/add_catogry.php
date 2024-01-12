<?php 

session_start();
// var_dump($_SESSION);

if(!isset($_SESSION['admin']) && !isset($_SESSION['login'])){
    header("location:admin_login.php");
}

require "../../inc/admin/header.php";
require "../../inc/admin/nav.php";




?>
<div class="container">

<div class="card">
    <div class="card-header">
        Add Category
    </div>
    <?php if(isset($_SESSION['message'])){?>
                            <p class="text-primary"> <?php echo $_SESSION['message']; ?></p>

                        <?php }?>
    <div class="card-body">

    <form action="../../handelers/admin/catogry/add.php" method='post'>
             <div class="form-group">
            <label for="catName"> Name:</label>
            <input type="text" class="form-control" id="catName" name='name'>
            </div> 
            <?php if(isset($_SESSION['errors']["name"]) && !empty($_SESSION['errors']["name"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['name']; ?></p>

                        <?php }?>
            <button type="submit" name='submit' class="btn btn-primary">add catogry</button>
    </form>

    </div>
</div>

<?php unset($_SESSION['errors'],$_SESSION['message']) ?>
>

</div>

<?php 


require "../../inc/admin/footer.php";
?>