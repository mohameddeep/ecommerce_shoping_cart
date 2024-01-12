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
        edit Category
    </div>
    <div class="card-body">
    <?php
       
            if(isset($_GET['id'])){
                $product_id=$_GET['id'];


                $statment=$database->prepare("SELECT * FROM product where id=:product_id");
                $statment->bindParam("product_id",$product_id);         
                $statment->execute();
                 $result=$statment->fetch(PDO::FETCH_OBJ);



                // var_dump($result);
            }
            ?>

        <form action="../../handelers/admin/product/edit.php" method="pOST" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php echo $result->id ?? "" ?>">

            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" 
                value="<?php echo $result->product_name ?? "" ?>"  name="name" aria-describedby="emailHelp" >
            </div>
            <?php if(isset($_SESSION['errors']["name"]) && !empty($_SESSION['errors']["name"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['name']; ?></p>

                        <?php }?>
            <div class="form-group">
                <label for="exampleInputEmail1">description</label>
                <input type="text" class="form-control" id="exampleInputEmail1" 
                value="<?php echo $result->product_descr ?? "" ?>"  name="descr" aria-describedby="emailHelp" >
            </div>
            <?php if(isset($_SESSION['errors']["descr"]) && !empty($_SESSION['errors']["descr"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['descr']; ?></p>

                        <?php }?>
            <div class="form-group">
                <label for="exampleInputEmail1">price</label>
                <input type="text" class="form-control" id="exampleInputEmail1" 
                value="<?php echo $result->price ?? "" ?>"  name="price" aria-describedby="emailHelp" >
            </div>
            <?php if(isset($_SESSION['errors']["price"]) && !empty($_SESSION['errors']["price"])){?>
                            <p class="text-danger"> <?php echo $_SESSION['errors']['price']; ?></p>

                        <?php }?>
            <div class="form-group">
                    <label for="exampleInputPassword1">catogry_name</label>
                    <select name="catogry_id" class="form-control" id="exampleInputPassword1">

                    
                         <?php
                       $sql=$database->prepare("SELECT * FROM catogry");
                       $sql->execute();

                       $rows=$sql->fetchAll(PDO::FETCH_OBJ);

                       //var_dump($rows);

                       foreach($rows as $row){
                        ?>
                        <option value="<?php echo $row->id?>" <?php 

                        if($row->id === $result->catogry_id){
                            echo "selected";
                        }else{
                            echo " ";
                        }
                        ?>><?php echo $row->catogry_name ?></option>
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
            <input type="submit" name="update" value="update product" class="btn btn-primary">
        </form>

                </div>
            </div>



            </div>

            <?php 


        require "../../inc/admin/footer.php";
        ?>


<!-- <br /><b>Warning</b>:  Undefined variable $result in <b>C:\xampp\htdocs\shoping-cart\view\admin\edit_catogry.php</b>
 on line <b>46</b><br /><br /><b>Warning</b>:  Attempt to read property  -->

