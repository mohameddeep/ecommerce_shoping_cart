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
                $catogry_id=$_GET['id'];


                $statment=$database->prepare("SELECT * FROM catogry where id=:catogry_id");
                $statment->bindParam("catogry_id",$catogry_id);         
                $statment->execute();
                $result=$statment->fetch(PDO::FETCH_OBJ);



                // var_dump($result);
            }
            ?>

        <form action="../../handelers/admin/catogry/edit.php" method="POST" >
        <input type="hidden" name="id" value="<?php echo $result->id ?? "" ?>">

        

            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" 
                value="<?php echo $result->catogry_name ?? "" ?>"  name="name" aria-describedby="emailHelp" >
            </div>
            
            <input type="submit" name="update" value="update catogry" class="btn btn-primary">
        </form>

                </div>
            </div>



            </div>

            <?php 


        require "../../inc/admin/footer.php";
        ?>


<!-- <br /><b>Warning</b>:  Undefined variable $result in <b>C:\xampp\htdocs\shoping-cart\view\admin\edit_catogry.php</b>
 on line <b>46</b><br /><br /><b>Warning</b>:  Attempt to read property  -->