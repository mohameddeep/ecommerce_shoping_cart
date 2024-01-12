<?php 

session_start();
// var_dump($_SESSION);

if(!isset($_SESSION['admin']) && !isset($_SESSION['login'])){
    header("location:admin_login.php");
}


require "../../inc/admin/header.php";
require "../../inc/admin/nav.php";
require "../../core/dbconnect.php";

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

    <form action="../../handelers/admin/product/add.php" method='post' enctype="multipart/form-data" >
            <div class="form-group">
            <label for="catName"> Name:</label>
            <input type="text" class="form-control" id="catName" name='name'>
            </div> 
            <?php if(isset($_SESSION['errors']["name"]) && !empty($_SESSION['errors']["name"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['name']; ?></p>

                        <?php }?>
            <div class="form-group">
            <label for="catName"> description:</label>
            <input type="text" class="form-control" id="catName" name='descr'>
            </div> 
            <?php if(isset($_SESSION['errors']["descr"]) && !empty($_SESSION['errors']["descr"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['descr']; ?></p>

                        <?php }?>
            <div class="form-group">
            <label for="catName"> price:</label>
            <input type="text" class="form-control" id="catName" name='price'>
            </div> 
            <?php if(isset($_SESSION['errors']["price"]) && !empty($_SESSION['errors']["price"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['price']; ?></p>

                        <?php }?>
            <div class="form-group">
                    <label for="exampleInputPassword1">catogry_name</label>
                    <select name="catogry_id" class="form-control" id="exampleInputPassword1">

                    
                        <option selected disabled>select your catogry</option>
                       <?php
                       $sql=$database->prepare("SELECT * FROM catogry");
                       $sql->execute();

                       $rows=$sql->fetchAll(PDO::FETCH_ASSOC);

                       var_dump($rows);

                       foreach($rows as $row){
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['catogry_name'] ?></option>
                        <?php }?>
                    </select>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <?php if(isset($_SESSION['errors']["image"]) && !empty($_SESSION['errors']["image"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['image']; ?></p>

                        <?php }?>
            <button type="submit" name='submit' class="btn btn-primary">add product</button>
    </form>

    </div>
</div>

<?php unset($_SESSION['errors'],$_SESSION['message']) ?>


</div>

<?php 


require "../../inc/admin/footer.php";
?>